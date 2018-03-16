<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'A Regular User';
        $role_user->save();

        $role_moderator = new Role();
        $role_moderator->name = 'moderator';
        $role_moderator->description = 'A Moderator';
        $role_moderator->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Administrator';
        $role_admin->save();
    }
}
