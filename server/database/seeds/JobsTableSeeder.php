<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'name' => 'ceo',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'ga',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'hr',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'nbdo',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'sales',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'planner',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'designer',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'engineer',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
