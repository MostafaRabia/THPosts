<?php

use Illuminate\Database\Seeder;

class Posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) { 
        	DB::table('posts')->insert([
        			'post'=>'post'.$i,
        			'title'=>'title'.$i,
        			'author'=>1,
        			'type'=>1,
        			'hash'=>1,
        			'image'=>'image.jpg'
        		]);
        }
    }
}
