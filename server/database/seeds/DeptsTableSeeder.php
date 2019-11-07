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
            'name' => '役員',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => 'SES',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => 'WEBクリ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => 'エンマネ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('depts')->insert([
            'name' => 'その他',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
