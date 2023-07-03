<?php

namespace Francerz\SepomexCatalogos\Model;

class TipoAsentamiento
{
    public $clave;
    public $nombre;

    public function __construct($clave, $nombre)
    {
        $this->clave = $clave;
        $this->nombre = $nombre;
    }
}
