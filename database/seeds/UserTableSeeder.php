<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_user = Role::where('name','User')->first();
       $role_editor = Role::where('name','Editor')->first();
       $role_admin = Role::where('name','Admin')->first();

       $user = new User();
       $user->name = "Kiran Admin";
       $user->email = "kiran@admin.com";
       $user->password = bcrypt('123456');
       $user->save();
       $user->roles()->attach($role_admin);
       
       $user = new User();
       $user->name = "Kiran Editor";
       $user->email = "kiran@editor.com";
       $user->password = bcrypt('123456');
       $user->save();
       $user->roles()->attach($role_editor);
       
       $user = new User();
       $user->name = "Kiran User";
       $user->email = "kiran@user.com";
       $user->password = bcrypt('123456');
       $user->save();
       $user->roles()->attach($role_user);


    }
}
