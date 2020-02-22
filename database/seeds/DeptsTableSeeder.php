<?php

use Illuminate\Database\Seeder;

class DeptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depts')->insert([
            'name' => '部署　壱',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => '部署　弐',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => '部署　参',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => '部署　肆',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => '部署　伍',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
