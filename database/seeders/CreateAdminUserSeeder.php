<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'BOTC',
            'namepic' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '085156971287',
            'password' => bcrypt('123456i')
        ]);

        $role = Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Corporate']);
        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
