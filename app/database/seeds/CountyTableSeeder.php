<?php
class CountyTableSeeder extends Seeder {

    public function run()
    {
        // !!! All existing users are deleted !!!
        DB::table('counties')->delete();

        County::create(array(
            'id'=>2,
            'name' => 'Montgomery'
        ));
        
        County::create(array(
            'id'=>1,
            'name' => 'Unknown'
        ));
       
    }
}
