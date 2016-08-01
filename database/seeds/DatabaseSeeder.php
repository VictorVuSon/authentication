<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
//        \App\Models::unguard();

//        $lipsum = new LoremIpsumGenerator;
        \App\Models\user::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('abc123'),
            'name' => 'Vu Ngoc Son',
            'avatar'=>'no-image.png',
            'is_admin' => 1,
        ]);

        \App\Models\user::create([
            'email' => 'guest@gmail.com',
            'password' => bcrypt('abc123'),
            'name' => 'Vu Ngoc Guest',
            'avatar'=>'no-image.png',
            'is_admin' => 0,
        ]);
        \App\Models\user::create([
            'email' => 'thanh@gmail.com',
            'password' => bcrypt('abc123'),
            'name' => 'Ngo Viet Thanh',
            'avatar'=>'no-image.png',
            'is_admin' => 0,
        ]);
        
        
        
        \App\Models\category::create([
            'name' => 'Seafood',
            'image' => 'no-image.png'
            
        ]);
        \App\Models\category::create([
            'name' => 'Cat2',
            'image' => 'no-image.png'
            
        ]);
        \App\Models\category::create([
            'name' => 'Cat3',
            'image' => 'no-image.png'
            
        ]);
        
        
        \App\Models\food::create([
            'name' => 'food1',
            'image' => 'no-image.png',
            'category_id' => 1,
            'content' => 'content content content content content content content content content ',
            'author' => 1,
        ]);
        
        \App\Models\food::create([
            'name' => 'food2',
            'image' => 'no-image.png',
            'category_id' => 2,
            'content' => 'content content content content content content content content content ',
            'author' => 2,
        ]);
        
        \App\Models\food::create([
            'name' => 'food3',
            'image' => 'no-image.png',
            'category_id' => 1,
            'content' => 'content content content content content content content content content ',
            'author' => 3,
        ]);
        
        \App\Models\food::create([
            'name' => 'food4',
            'image' => 'no-image.png',
            'category_id' => 2,
            'content' => 'content content content content content content content content content ',
            'author' => 2,
        ]);
        
        \App\Models\page::create([
            'name' => 'page 1',
            'content' => 'content content content content content content content content content ',
        ]);
        
    }

}
