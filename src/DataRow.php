<?php

namespace Francerz\SepomexCatalogos;

class DataRow
{
    public $claveAsentamiento;
    public $claveCiudad;
    public $claveEstado;
    public $claveMunicipio;
    public $claveTipoAsentamiento;
    public $codigoPostal;
    public $codigoPostalOficina;
    public $nombreAsentamiento;
    public $nombreCiudad;
    public $nombreEstado;
    public $nombreMunicipio;
    public $nombreTipoAsentamiento;
    public $zona;

    public static function fromLine(string $line)
    {
        $parts = explode('|', $line);

        $instance = new static();
        $instance->codigoPostal = $parts[0] ?? null;
        $instance->nombreAsentamiento = $parts[1] ?? null;
        $instance->nombreTipoAsentamiento = $parts[2] ?? null;
        $instance->nombreMunicipio = $parts[3] ?? null;
        $instance->nombreEstado = $parts[4] ?? null;
        $instance->nombreCiudad = $parts[5] ?? null;
        $instance->codigoPostalOficina = $parts[6] ?? $parts[8] ?? null;
        $instance->claveEstado = $parts[7] ?? null;
        $instance->claveTipoAsentamiento = $parts[10] ?? null;
        $instance->claveMunicipio = $parts[11] ?? null;
        $instance->claveAsentamiento = $parts[12] ?? null;
        $instance->zona = $parts[13] ?? null;
        $instance->claveCiudad = $parts[14] ?? null;
        return $instance;
    }
}
