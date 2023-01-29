<?php

namespace Database\Seeders;

use App\Models\{Menu, MenuLevel, User};
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuLevel::insert([
            ['level' => 1],
            ['level' => 2],
            ['level' => 3],
        ]);

        Menu::insert([
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'Dashboard', 'menu_link' => '/app', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'User', 'menu_link' => '/app/user', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'Menu', 'menu_link' => '/app/menu', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'User Activity', 'menu_link' => '/app/activity', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'Error log', 'menu_link' => '/app/error-log', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'About', 'menu_link' => '/app/about', 'created_at' => now(), 'updated_at'=> now()],
            ['id_level' => 1, 'parent_id' => null, 'menu_name' => 'Profil', 'menu_link' => '/app/profil', 'created_at' => now(), 'updated_at'=> now()],
        ]);

        $user = User::find(1);

        $user->menus()->attach([1,2,3,4,5,6,7]);
    }
}
