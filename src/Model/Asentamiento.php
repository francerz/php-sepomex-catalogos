<?php

namespace Francerz\SepomexCatalogos\Model;

class Asentamiento
{
    public $estado;
    public $municipio;
    public $clave;
    public $nombre;
    public $zona;
    public $codigoPostal;
    public $codigoPostalOficina;

    public $ciudad;
    public $tipoAsentamiento;

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
}
