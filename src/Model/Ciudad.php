<?php

namespace Francerz\SepomexCatalogos\Model;

/**
 * @property-read Estado $estado
 * @property-read string $clave
 * @property-read string $nombre
 */
class Ciudad
{
    private $estado;
    private $clave;
    private $nombre;

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
        }
    }
}
