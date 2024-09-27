<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    
    public function testSumaCorrecta()
    {
        $resultado = 2 + 3;
        $this->assertEquals(5, $resultado);
    }

}
