<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkoutPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workoutplans')->insert([
            [
                'course_name' => 'Beginner Yoga',
                'course_type' => 'Yoga',
                'schedule' => 'Mon, Wed, Fri',
                'duration' => '4 weeks',
                'requirement' => 'Yoga mat',
                'price' => 50.00,
                'course_description' => 'An introductory course to Yoga.',
                'course_image' => 'yoga1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Advanced Pilates',
                'course_type' => 'Pilates',
                'schedule' => 'Tue, Thu',
                'duration' => '6 weeks',
                'requirement' => 'Pilates ball',
                'price' => 75.00,
                'course_description' => 'An advanced course for Pilates enthusiasts.',
                'course_image' => 'pilates1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'HIIT Training',
                'course_type' => 'HIIT',
                'schedule' => 'Mon, Wed, Fri',
                'duration' => '8 weeks',
                'requirement' => 'None',
                'price' => 100.00,
                'course_description' => 'High-Intensity Interval Training for maximum results.',
                'course_image' => 'hiit1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Strength Training',
                'course_type' => 'Strength',
                'schedule' => 'Tue, Thu, Sat',
                'duration' => '8 weeks',
                'requirement' => 'Dumbbells',
                'price' => 85.00,
                'course_description' => 'A comprehensive strength training program.',
                'course_image' => 'strength1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Zumba Fitness',
                'course_type' => 'Zumba',
                'schedule' => 'Mon, Wed, Fri',
                'duration' => '6 weeks',
                'requirement' => 'None',
                'price' => 60.00,
                'course_description' => 'Fun and energetic Zumba sessions.',
                'course_image' => 'zumba1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Cycling Classes',
                'course_type' => 'Cycling',
                'schedule' => 'Tue, Thu, Sat',
                'duration' => '8 weeks',
                'requirement' => 'Cycling shoes',
                'price' => 90.00,
                'course_description' => 'Intense indoor cycling workouts.',
                'course_image' => 'cycling1.jpg',
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
