<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ["email" => "admin"],
            [
                "name" => "Administrador",
                "password" => Hash::make("admin"),
                "email_verified_at" => now()
            ]
        );

        // Give admin permissions to User "admin"
        Artisan::call("voyager:admin", [
            "email" => "admin"
        ]);

        User::updateOrCreate(
            ["email" => "user"],
            [
                "name" => "Usuario Normal",
                "password" => Hash::make("user"),
                "email_verified_at" => now()
            ]
        );

        $role = Role::where('name', 'user')->firstOrFail();

        $permissions = Permission::where("key", '=', "browse_admin")->orWhere("table_name", '=', 'entries')->get();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
