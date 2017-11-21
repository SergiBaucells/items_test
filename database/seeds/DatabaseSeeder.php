<?php

use Baucells\Items\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class,50)->create();
        Artisan::call('passport:install');
    }
}
