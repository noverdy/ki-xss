<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => env('ADMIN_POST_TITLE'),
            'slug' => Str::slug(env('ADMIN_POST_TITLE') . '-' . Str::random(4)),
            'content' => env('ADMIN_POST_CONTENT'),
            'visibility' => '2',
            'user_id' => User::where('nim', env('ADMIN_USERNAME'))->first()->id,
        ]);
        Post::factory(50)->create();
    }
}
