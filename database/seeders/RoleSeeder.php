<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'id'    => 1,
                'title' => 'admin',
            ],
            [
                'id'    => 2,
                'title' => 'diretor',
            ],
            [
                'id'    => 3,
                'title' => 'coordenador',
            ],
            [
                'id'    => 4,
                'title' => 'ti',
            ],
        ];

        Role::insert($role);
    }
}
