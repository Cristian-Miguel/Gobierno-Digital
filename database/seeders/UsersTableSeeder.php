<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

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

        $role2 = new Role();
        $role2->name = 'Usuario';
        $role2->slug = 'Read';
        $role2->description = "Puede solo leer los datos del sistema";
        $role2->save();

        $names = [
            'Waldo', 'Zed', 'Alfiel', 'Corenda', 'Shaina', 
            'Gilberto', 'Constantine', 'Mic', 'Nicole', 'Lili',
            'Sharla', 'Hilary', 'Garrik', 'Celle', 'Samuel'
        ];
        
        for ($i=0; $i < 15; $i++) { 
            $user = new User();
            $user->name = $names[$i];
            $user->email = $names[$i]."@hotmail.com";
            $user->email_verified_at = Carbon::now();
            $user->password = Hash::make('password');
            $user->save();

            $role_user = new RoleUser();
            if( $i%2==0 ) {
                $id = DB::Select('SELECT id FROM users ORDER BY id DESC LIMIT 1');
                $role_user->user_id = $id[0]->id;
                $role_user->role_id = 1;
                $role_user->save();
            } else {
                $id = DB::Select('SELECT id FROM users ORDER BY id DESC LIMIT 1');
                $role_user->user_id = $id[0]->id;
                $role_user->role_id = 2;
                $role_user->save();
            }
        }
    }    
}
