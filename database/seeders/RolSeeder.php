<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Fisioterapeuta']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.user.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.rol.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.permiso.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'doctor.paciente.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.paciente.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.paciente.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.paciente.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'doctor.consulta.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.consulta.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.consulta.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.consulta.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'doctor.reporte.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.reporte.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.reporte.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'doctor.reporte.destroy'])->syncRoles([$role1, $role2]);

    }
}
