<?php

namespace Francerz\SepomexCatalogos\Tests;

use Francerz\SepomexCatalogos\Catalogo;
use PHPUnit\Framework\TestCase;

class CatalogoTest extends TestCase
{
    private const TEST_FILE_PATH = __DIR__ . '/demodata.txt';

    public function testFromTextFile()
    {
        $ramStart = memory_get_usage(true);
        $catalogo = Catalogo::fromTextFile(self::TEST_FILE_PATH);
        $ramEnd = memory_get_usage(true);
        echo sprintf("Used RAM: %d", $ramEnd - $ramStart);
        $this->assertEquals(2, count($catalogo->tiposAsentamiento));
        $this->assertEquals(2, count($catalogo->estados));
        $this->assertEquals(3, count($catalogo->municipios));
        $this->assertEquals(1, count($catalogo->ciudades));
        $this->assertEquals(4, count($catalogo->asentamientos));
        $this->assertTrue(true);
    }
}
