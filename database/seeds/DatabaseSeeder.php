<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class,10)->create();
        factory(\App\Post::class,10)->create();
        factory(\App\Video::class,10)->create();

        DB::table('users')->insert([
            'name'=>'Md.Admin',
            'email'=>'admin@gmail.com',
            'type'=>'admin',
            'password'=>bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'name'=>'Md.Author',
            'type'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('user'),
        ]);
    }
}
