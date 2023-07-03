<?php

namespace Francerz\SepomexCatalogos\Model;

class Estado
{
    public $clave;
    public $nombre;

    public function __construct(string $clave, string $nombre)
    {
        $this->clave = $clave;
        $this->nombre = $nombre;
    }
}
