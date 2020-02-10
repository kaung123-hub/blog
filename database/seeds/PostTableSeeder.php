<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

use Faker\Factory as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i=0;$i<=449;$i++){
        // DB::table('blog_posts')->insert([
        //     'title' => Str::random(15),
        //     'author' => Str::random(10),
        //     'content' => Str::random(100),
        //     'created_at'=>Carbon::parse('2020-01-01'),
        //     'updated_at'=>Carbon::parse('2020-01-01')
        // ]);
        // } //--create fake data

            $faker = Faker::create('App\BlogPost');
            for($i=0;$i<=300;$i++){
                DB::table('blog_posts')->insert([
                    'title' => $faker -> sentence($nbWords = 3,$variableNbWords = true),
                    'author' => $faker -> name(),
                    'content' => $faker ->paragraph(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
    }
}
