<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => '1 and 2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('groups')->insert([
            'name' => '1 and 3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
