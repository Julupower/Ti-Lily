<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            
            ['user_id' => 1, 'post_id' => 1, 'content' => "Test comment #1"],
            ['user_id' => 2, 'post_id' => 2, 'content' => "Test comment #2"],
            ['user_id' => 3, 'post_id' => 3, 'content' => "Test comment #3"],
            ['user_id' => 4, 'post_id' => 4, 'content' => "Test comment #4"],
            ['user_id' => 5, 'post_id' => 5, 'content' => "Test comment #5"],
            ['user_id' => 6, 'post_id' => 6, 'content' => "Test comment #6"],
            ['user_id' => 7, 'post_id' => 7, 'content' => "Test comment #7"],
            ['user_id' => 8, 'post_id' => 8, 'content' => "Test comment #8"],
            ['user_id' => 9, 'post_id' => 9, 'content' => "Test comment #9"],
            ['user_id' => 10, 'post_id' => 10, 'content' => "Test comment #10"],
            ['user_id' => 11, 'post_id' => 11, 'content' => "Test comment #11"],
            ['user_id' => 12, 'post_id' => 12, 'content' => "Test comment #12"],
            ['user_id' => 13, 'post_id' => 13, 'content' => "Test comment #13"]
        ]);
    }
}
