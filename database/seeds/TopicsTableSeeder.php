<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Topic::class)->create(['name' => 'Sport', 'description' => 'Sport description']);
        factory(App\Topic::class)->create(['name' => 'Science', 'description' => 'Science description']);
        factory(App\Topic::class)->create(['name' => 'Literature', 'description' => 'Literature description']);
        factory(App\Topic::class)->create(['name' => 'Health', 'description' => 'Health description']);
        factory(App\Topic::class)->create(['name' => 'News', 'description' => 'News description']);
        factory(App\Topic::class)->create(['name' => 'Art', 'description' => 'Art description']);


    }
}
