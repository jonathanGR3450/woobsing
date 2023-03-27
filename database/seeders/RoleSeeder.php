<?php

namespace Database\Seeders;

use App\Domain\User\ValueObjects\RoleId;
use App\Infrastructure\Laravel\Models\Permission;
use App\Infrastructure\Laravel\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $role1 = Role::create([
            'name' => 'admin'
        ]);

        $role2 = Role::create([
            'name' => 'user'
        ]);

        $permission1 = Permission::create([
            'name' => 'can_login'
        ]);

        $permission2 = Permission::create([
            'name' => 'can_register'
        ]);

        $permission3 = Permission::create([
            'name' => 'show_history'
        ]);

        $role1->permissions()->attach([$permission1->id, $permission2->id, $permission3->id]);

        $role2->permissions()->attach([$permission1->id, $permission2->id]);


    }
}
