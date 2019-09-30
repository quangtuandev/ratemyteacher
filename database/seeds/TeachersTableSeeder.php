<?php

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Center;
use App\Models\Media;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::truncate();
        Media::truncate();
        factory(Teacher::class, 15)->create()->each(function ($teacher) {
            $range = rand(2, 5);
            // Save photo for teacher
            $teacher->media()->saveMany(factory(Media::class, $range)->make());
            $idCenter = Center::all()->random(1);
            $teacher->centers()->attach($idCenter);
        });

    }
}
