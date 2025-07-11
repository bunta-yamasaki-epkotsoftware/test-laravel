<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts =
        [
            ['title' => 'First Post', 'content' => 'This is the content of the first post.'],
            ['title' => 'Second Post', 'content' => 'This is the content of the second post.'],
            ['title' => 'Third Post', 'content' => 'This is the content of the third post.'],
        ];

        foreach ($posts as $post){
            Post::create($post);
        }
    }
}
