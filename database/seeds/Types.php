<?php

use Illuminate\Database\Seeder;

class Types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('types')->insert([
    			['type'=>'ادبي','hash'=>'#البوست_الادبي'],
    			['type'=>'علمي','hash'=>'#البوست_العلمي'],
    			['type'=>'ديني','hash'=>'#البوست_الديني'],
    			['type'=>'تاريخي','hash'=>'#البوست_تاريخي'],
    		]);
    }
}
