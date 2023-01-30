<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        CategoryModel::factory()
        ->count(3)
        ->state(new Sequence(
            [ 'name' => 'PHP' ],
            [ 'name' => 'JS' ],
            [ 'name' => 'CSS' ],
        ))
        ->create();
    }
}
