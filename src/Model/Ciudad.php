<?php

namespace Francerz\SepomexCatalogos\Model;

class Ciudad
{
    public $estado;
    public $municipio;
    public $clave;
    public $nombre;

    public function __construct(Estado $estado, Municipio $municipio, string $clave, string $nombre)
    {
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->clave = $clave;
        $this->nombre = $nombre;
    }
}
