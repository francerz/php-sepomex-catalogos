<?php

namespace Francerz\SepomexCatalogos;

use Francerz\PowerData\Index;
use Francerz\SepomexCatalogos\Model\Asentamiento;
use Francerz\SepomexCatalogos\Model\Ciudad;
use Francerz\SepomexCatalogos\Model\Estado;
use Francerz\SepomexCatalogos\Model\Municipio;
use Francerz\SepomexCatalogos\Model\TipoAsentamiento;

/**
 * @property-read TipoAsentamiento[] $tiposAsentamiento
 * @property-read Estado[] $estados
 * @property-read Municipio[] $municipios
 * @property-read Ciudad[] $ciudades
 * @property-read Asentamiento[] $asentamientos
 */
class Catalogo
{
    public static function fromTextFile(string $filepath)
    {
        ini_set('memory_limit', -1);
        $file = fopen($filepath, 'r');
        $rows = [];
        for ($x = 0; $x < 2; $x++) {
            fgets($file);
        }

        // READS FILE LINE BY LINE
        while ($line = trim(fgets($file))) {
            $line = mb_convert_encoding($line, 'UTF-8', 'ISO-8859-1');
            $rows[] = DataRow::fromLine($line);
        }

        // CREATES INDEX WITH ROWS
        $rowsIndex = new Index($rows, [
            'claveEstado',
            'claveTipoAsentamiento'
        ]);

        // FILTERS ALL TIPOS ASENTAMIENTO
        $tiposAsentamiento = [];
        foreach ($rowsIndex->getColumnValues('claveTipoAsentamiento') as $cta) {
            /** @var DataRow */
            $r = $rowsIndex->first(['claveTipoAsentamiento' => $cta]);
            $tiposAsentamiento[$cta] = new TipoAsentamiento(
                $r->claveTipoAsentamiento,
                $r->nombreTipoAsentamiento
            );
        }

        // FILTERS ESTADOS
        $estados = [];
        $municipios = [];
        $ciudades = [];
        $asentamientos = [];
        foreach ($rowsIndex->getColumnValues('claveEstado') as $ce) {
            /** @var DataRow[] */
            $estadoData = $rowsIndex[['claveEstado' => $ce]];
            $re = reset($estadoData);
            $estados[$ce] = $estado = new Estado($re->claveEstado, $re->nombreEstado);

            // CREATES INDEX DE ESTADO
            $estadoIndex = new Index($estadoData, ['claveMunicipio', 'claveCiudad']);

            foreach ($estadoIndex->getColumnValues('claveCiudad') as $cc) {
                if (empty($cc)) {
                    continue;
                }
                /** @var DataRow */
                $rc = $estadoIndex->first(['claveCiudad' => $cc]);
                $ciudades["{$ce}-{$cc}"] = $estado->addCiudad($rc->claveCiudad, $rc->nombreCiudad);
            }
            foreach ($estadoIndex->getColumnValues('claveMunicipio') as $cm) {
                /** @var DataRow[] */
                $municipioData = $estadoIndex[['claveMunicipio' => $cm]];
                $rm = reset($municipioData);
                $municipios["{$ce}-{$cm}"] = $municipio = $estado->addMunicipio($cm, $rm->nombreMunicipio);

                $municipioIndex = new Index($municipioData, ['claveAsentamiento']);
                foreach ($municipioIndex->getColumnValues('claveAsentamiento') as $ca) {
                    /** @var DataRow */
                    $ra = $municipioIndex->first(['claveAsentamiento' => $ca]);
                    $asentamientos["{$ce}-{$cm}-{$ca}"] = $municipio->addAsentamiento(
                        $tiposAsentamiento[$ra->claveTipoAsentamiento],
                        $ra->claveAsentamiento,
                        $ra->nombreAsentamiento,
                        $ra->zona,
                        $ra->codigoPostal,
                        $ra->codigoPostalOficina,
                        $ciudades["{$ce}-{$ra->claveCiudad}"] ?? null
                    );
                }
            }
        }

        return new static(
            $tiposAsentamiento,
            $estados,
            $municipios,
            $ciudades,
            $asentamientos
        );
    }

    private $tiposAsentamiento;
    private $estados;
    private $municipios;
    private $ciudades;
    private $asentamientos;

    /**
     * @param TipoAsentamiento[] $tiposAsentamiento
     * @param Estado[] $estados
     * @param Municipio[] $municipios
     * @param Ciudad[] $ciudades
     * @param Asentamiento[] $asentamientos
     */
    private function __construct(
        array $tiposAsentamiento,
        array $estados,
        array $municipios,
        array $ciudades,
        array $asentamientos
    ) {
        $this->tiposAsentamiento = $tiposAsentamiento;
        $this->estados = $estados;
        $this->municipios = $municipios;
        $this->ciudades = $ciudades;
        $this->asentamientos = $asentamientos;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'tiposAsentamiento':
                return $this->tiposAsentamiento;
            case 'estados':
                return $this->estados;
            case 'municipios':
                return $this->municipios;
            case 'ciudades':
                return $this->ciudades;
            case 'asentamientos':
                return $this->asentamientos;
        }
    }
}
