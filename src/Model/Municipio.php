<?php

namespace Francerz\SepomexCatalogos\Model;

/**
 * @property-read Estado $estado
 * @property-read string $clave
 * @property-read string $nombre
 * @property-read Asentamiento[] $asentamientos
 */
class Municipio
{
    /** @var Estado */
    private $estado;
    /** @var string */
    private $clave;
    /** @var string */
    private $nombre;

    /** @var Asentamiento[] */
    private $asentamientos = [];

    public function __construct(Estado $estado, string $clave, string $nombre)
    {
        $this->estado = $estado;
        $this->clave = $clave;
        $this->nombre = $nombre;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'estado':
                return $this->estado;
            case 'clave':
                return $this->clave;
            case 'nombre':
                return $this->nombre;
            case 'asentamientos':
                return $this->asentamientos;
        }
    }

    public function addAsentamiento(
        TipoAsentamiento $tipo,
        string $clave,
        string $nombre,
        string $zona,
        string $codigoPostal,
        string $codigoPostalOficina,
        ?Ciudad $ciudad = null
    ) {
        $asentamiento = new Asentamiento(
            $this,
            $tipo,
            $clave,
            $nombre,
            $zona,
            $codigoPostal,
            $codigoPostalOficina,
            $ciudad
        );
        $this->asentamientos[$clave] = $asentamiento;
        return $asentamiento;
    }
}
