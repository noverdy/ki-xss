<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('nim', env('ADMIN_USERNAME'))->where('name', 'Admin')->get();
        if (is_null($admin->first())) {
            User::create([
                'nim' => env('ADMIN_USERNAME'),
                'name' => 'Admin',
            ]);
            User::factory(10)->create();
        }
    }
}
