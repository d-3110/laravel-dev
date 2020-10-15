<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DeptsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(AttendanceRecordsTableSeeder::class);
        $this->call(PaidHolidaysTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(GroupUserTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
