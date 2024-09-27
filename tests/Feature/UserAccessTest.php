<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserAccessTest extends TestCase
{

    use DatabaseTransactions;
    /** @test */
    public function admin_can_access_admin_routes()
    {
        // Crear un usuario con rol admin
        $admin = User::factory()->create();
        $admin->assignRole('Admin'); // Asigna el rol de admin

        // Verificar que el admin puede acceder a las rutas
        $response = $this->actingAs($admin)->get(route('admin.user.index'));
        $response->assertStatus(200); // Se espera un 200 OK

        $response = $this->actingAs($admin)->get(route('admin.rol.index'));
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get(route('admin.permiso.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function fisioterapeuta_can_not_access_admin_routes()
    {
        // Crear un usuario con rol fisioterapeuta
        $fisioterapeuta = User::factory()->create();
        $fisioterapeuta->assignRole('fisioterapeuta'); // Asigna el rol de fisioterapeuta

        // Verificar que el fisioterapeuta no puede acceder a las rutas
        $response = $this->actingAs($fisioterapeuta)->get(route('admin.user.index'));
        $response->assertStatus(403); // Se espera un 403 Forbidden

        $response = $this->actingAs($fisioterapeuta)->get(route('admin.rol.index'));
        $response->assertStatus(403);

        $response = $this->actingAs($fisioterapeuta)->get(route('admin.permiso.index'));
        $response->assertStatus(403);
    }

    /** @test */
    public function fisioterapeuta_can_access_doctor_routes()
    {
        // Crear un usuario con rol fisioterapeuta
        $fisioterapeuta = User::factory()->create();
        $fisioterapeuta->assignRole('fisioterapeuta');
   
        // Verificar que el fisioterapeuta puede acceder a las rutas de doctor
        $response = $this->actingAs($fisioterapeuta)->get(route('doctor.paciente.index'));
        $response->assertStatus(200);
   
        $response = $this->actingAs($fisioterapeuta)->get(route('doctor.consulta.index'));
        $response->assertStatus(200);
   
        $response = $this->actingAs($fisioterapeuta)->get(route('doctor.reporte.index'));
        $response->assertStatus(200);
    }
   
}
