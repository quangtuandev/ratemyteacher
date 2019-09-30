<?php

use Illuminate\Database\Seeder;
use App\Models\Center;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Center::truncate();
        \DB::table('center_teacher')->truncate();
        factory(Center::class, 5)->create();

    }
}
