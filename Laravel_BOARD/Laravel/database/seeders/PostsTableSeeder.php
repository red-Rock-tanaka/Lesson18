<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([

['post' => '1つ目の投稿になります'],

['post' => '投稿二つ目'],

['post' => 'Ⅲつある'],

['post' => '４個目の透子'],

['post' => '投稿機能モデル']

]);
    }
}
