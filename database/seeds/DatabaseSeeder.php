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
        Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CentersTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(ReviewTableSeeder::class);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
