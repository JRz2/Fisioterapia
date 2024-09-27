<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PruebaIntegracion extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUsuarioSeCreaCorrectamente()
    {
        $response = $this->post('/usuarios', [
            'name' => 'Test User',
            'email' => 'test@usuario.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'test@usuario.com'
        ]);
    }

}
