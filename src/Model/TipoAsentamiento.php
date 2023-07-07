<?php

namespace Francerz\SepomexCatalogos\Model;

/**
 * @property-read string $clave
 * @property-read string $nombre
 */
class TipoAsentamiento
{
    private $clave;
    private $nombre;

    public function __construct(string $clave, string $nombre)
    {
        $this->clave = $clave;
        $this->nombre = $nombre;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'clave':
                return $this->clave;
            case 'nombre':
                return $this->nombre;
        }
    }
}
