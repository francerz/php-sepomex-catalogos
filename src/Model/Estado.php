<?php

namespace Francerz\SepomexCatalogos\Model;

/**
 * @property-read string $clave
 * @property-read string $nombre
 * @property-read Ciudad[] $ciudades
 * @property-read Municipio[] $municipios
 */
class Estado
{
    /** @var string */
    private $clave;
    /** @var string */
    private $nombre;
    /** @var Ciudad[] */
    private $ciudades = [];
    /** @var Municipio[] */
    private $municipios = [];

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
            case 'ciudades':
                return $this->ciudades;
            case 'municipios':
                return $this->municipios;
        }
    }

    public function addCiudad(string $clave, string $nombre)
    {
        $ciudad = new Ciudad($this, $clave, $nombre);
        $this->ciudades[$clave] = $ciudad;
        return $ciudad;
    }

    public function addMunicipio(string $clave, string $nombre)
    {
        $municipio = new Municipio($this, $clave, $nombre);
        $this->municipios[$clave] = $municipio;
        return $municipio;
    }
}
