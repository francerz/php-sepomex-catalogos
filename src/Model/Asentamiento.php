<?php

namespace Francerz\SepomexCatalogos\Model;

/**
 * @property-read Estado $estado
 * @property-read Municipio $municipio
 * @property-read string $clave
 * @property-read string $nombre
 * @property-read string $zona
 * @property-read string $codigoPostal
 * @property-read string $codigoPostalOficina
 * @property-read TipoAsentamiento $tipoAsentamiento
 * @property-read ?Ciudad $ciudad
 */
class Asentamiento
{
    private $estado;
    private $municipio;
    private $clave;
    private $nombre;
    private $zona;
    private $codigoPostal;
    private $codigoPostalOficina;

    private $ciudad;
    private $tipoAsentamiento;

    public function __construct(
        Estado $estado,
        Municipio $municipio,
        TipoAsentamiento $tipoAsentamiento,
        string $clave,
        string $nombre,
        string $zona,
        string $codigoPostal,
        string $codigoPostalOficina,
        ?Ciudad $ciudad = null
    ) {
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->tipoAsentamiento = $tipoAsentamiento;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->zona = $zona;
        $this->codigoPostal = $codigoPostal;
        $this->codigoPostalOficina = $codigoPostalOficina;
        $this->ciudad = $ciudad;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'estado':
                return $this->estado;
            case 'municipio':
                return $this->municipio;
            case 'tipoAsentamiento':
                return $this->tipoAsentamiento;
            case 'clave':
                return $this->clave;
            case 'nombre':
                return $this->nombre;
            case 'zona':
                return $this->zona;
            case 'codigoPostal':
                return $this->codigoPostal;
            case 'codigoPostalOficina':
                return $this->codigoPostalOficina;
            case 'ciudad':
                return $this->ciudad;
        }
    }
}
