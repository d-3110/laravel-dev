<?php

use Illuminate\Database\Seeder;

class PaidHolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 有効
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
        // 有効２
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
        // 有効３
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
        // 有効４
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
        // 有効５
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);

        // 使用済み
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2019-10-01',
            'expire_date' => '2099-10-01',
            'use_date'    => '2019-10-02',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
        // 期限切れ
        DB::table('paid_holidays')->insert([
            'user_id'     => 1,
            'grant_date'  => '2000-10-01',
            'expire_date' => '2000-10-01',
            'created_at'  => new DateTime(),
            'updated_at'  => new DateTime(),
        ]);
    }
}
