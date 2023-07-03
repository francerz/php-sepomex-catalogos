<?php

namespace Francerz\SepomexCatalogos\Model;

class Municipio
{
    public $estado;
    public $clave;
    public $nombre;

    public function __construct(Estado $estado, string $clave, string $nombre)
    {
        $this->estado = $estado;
        $this->clave = $clave;
        $this->nombre = $nombre;
    }
}
