<?php

namespace Database\Seeders;

use App\Models\product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(5)->create();
        // product::factory(15)->create();
        Tag::factory(10)->create();
    }
}
