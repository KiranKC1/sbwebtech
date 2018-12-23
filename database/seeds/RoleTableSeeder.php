<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'This User a super User. He can do anything to the files',
        ]);

        DB::table('roles')->insert([
            'name' => 'Editor',
            'description' => 'This is an Editor User. He can add Posts',
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'description' => 'This is a Normal User. He can add Posts',
        ]);
    }
}
