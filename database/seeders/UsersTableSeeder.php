<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Role_User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrador';
        $role->slug = 'all';
        $role->description = "Tiene acceso completo a todo el sistema";
        $role->save();

        $role = new Role();
        $role->name = 'Usuario';
        $role->slug = 'Read';
        $role->description = "Puede solo leer los datos del sistema";
        $role->save();

        User::truncate();
        $user = new User();
        for ($i=0; $i < 15; $i++) { 
            $user->name = Str::random(10);
            $user->email = Str::random(10)."@hotmail.com";
            $user->email_verified_at = Carbon::now();
            $user->password = Hash::make('password');
            $user->remember_token = createToken('Token')->accessToken;
            $user->save();
            $role_user = new Role_User();
            if( $i%2==0 ) {
                // $role_user = 

            } else {

            }
        }


    }    
}
