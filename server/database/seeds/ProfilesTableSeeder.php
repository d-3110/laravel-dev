<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 20件作成
        for($i=1; $i < 21; $i++) {
            factory(App\Profile::class)->create(['user_id' => $i]);
        }
    }
}
