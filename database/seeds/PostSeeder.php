<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('posts')->insert([
            ['user_id' => 1, 'title' => "Test Post #1", 'content' => "This is the 1st test post"],
            ['user_id' => 2, 'title' => "Test Post #2", 'content' => "This is the 2nd test post"],
            ['user_id' => 3, 'title' => "Test Post #3", 'content' => "This is the 3rd test post"],
            ['user_id' => 4, 'title' => "Test Post #4", 'content' => "This is the 4th test post"],
            ['user_id' => 5, 'title' => "Test Post #5", 'content' => "This is the 5th test post"],
            ['user_id' => 6, 'title' => "Test Post #6", 'content' => "This is the 6th test post"],
            ['user_id' => 7, 'title' => "Test Post #7", 'content' => "This is the 7th test post"],
            ['user_id' => 8, 'title' => "Test Post #8", 'content' => "This is the 8th test post"],
            ['user_id' => 9, 'title' => "Test Post #9", 'content' => "This is the 9th test post"],
            ['user_id' => 10, 'title' => "Test Post #10", 'content' => "This is the 10th test post"],
            ['user_id' => 11, 'title' => "Test Post #11", 'content' => "This is the 11th test post"],
            ['user_id' => 12, 'title' => "Test Post #12", 'content' => "This is the 12th test post"],
            ['user_id' => 13, 'title' => "Test Post #13", 'content' => "This is the 13th test post"]
        ]);
    }
}
