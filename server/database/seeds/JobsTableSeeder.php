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
            'name' => 'ディレクター',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'デザイナー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'フロントエンジニア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'バックエンドエンジニア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => 'インフラエンジニア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => '営業',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => '事務',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('jobs')->insert([
            'name' => '役員',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
