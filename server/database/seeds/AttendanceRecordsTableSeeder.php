<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now()->startOfMonth();

        // 1日
        DB::table('attendance_records')->insert([
                'user_id' => 1,
                'date' => $dt->format('Y-m-d'),
                'start_time' => '09:00:00',
                'break_time' => '01:00:00',
                'end_time' => '18:00:00',
                'actual' => 8.0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);

        // 残り19日分
        for ($i=0; $i < 19; $i++) {
            DB::table('attendance_records')->insert([
                'user_id' => 1,
                'date' => $dt->addDays(1)->format('Y-m-d'),
                'start_time' => '09:00:00',
                'break_time' => '01:00:00',
                'end_time' => '18:00:00',
                'actual' => 8.0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
