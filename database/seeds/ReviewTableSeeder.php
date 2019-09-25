<?php

use Illuminate\Database\Seeder;
use App\Models\ReviewTeacher;
class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReviewTeacher::truncate();
        factory(ReviewTeacher::class, 20)->create();
    }
}
