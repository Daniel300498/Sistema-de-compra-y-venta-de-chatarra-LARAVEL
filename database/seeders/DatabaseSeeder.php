<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Permisos, roles y usuario superadmin
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // 2. Parámetros del sistema (países, grupos, lugar CI)
        $this->call(ParametrosTableSeeder::class);

        // 3. Proveedores y clientes (sin dependencias entre sí)
        $this->call(ProveedorsTableSeeder::class);
        $this->call(ClientesTableSeeder::class);

        // 4. Contactos (dependen de clientes y proveedores)
        $this->call(ContactosTableSeeder::class);

        // 5. Operadores de transporte (base para camiones)
        $this->call(OperadoresTransporteTableSeeder::class);

        // 6. Camiones (dependen de operadores como propietario)
        $this->call(CamionesTableSeeder::class);

        // 7. Contratos (dependen de clientes y proveedores)
        $this->call(ContratosTableSeeder::class);
    }
}
