<?php

namespace Database\Seeders;

use App\Models\LearningPath;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = [
            [
                'title' => 'Full Stack Web Development',
                'description' => 'Master both frontend and backend development to become a full stack developer.',
                'difficulty_level' => 'intermediate',
                'estimated_duration' => '6 months',
                'image_url' => 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'Data Science Career Path',
                'description' => 'Comprehensive path to become a data scientist, from basics to advanced concepts.',
                'difficulty_level' => 'advanced',
                'estimated_duration' => '8 months',
                'image_url' => 'https://images.pexels.com/photos/8386440/pexels-photo-8386440.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Learn to build professional mobile applications for iOS and Android.',
                'difficulty_level' => 'intermediate',
                'estimated_duration' => '5 months',
                'image_url' => 'https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'Cloud Computing & DevOps',
                'description' => 'Master cloud computing and DevOps practices for modern software development.',
                'difficulty_level' => 'advanced',
                'estimated_duration' => '7 months',
                'image_url' => 'https://images.pexels.com/photos/8386422/pexels-photo-8386422.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        ];

        foreach ($paths as $path) {
            $learningPath = LearningPath::firstOrCreate(
                ['title' => $path['title']],
                $path
            );

            // Attach courses to the learning path
            if ($path['title'] === 'Web Development Career Path') {
                $courses = Course::whereIn('slug', [
                    'web-development-fundamentals',
                    'advanced-javascript'
                ])->get();
            } else {
                $courses = Course::whereIn('slug', [
                    'web-development-fundamentals',
                    'advanced-javascript',
                    'full-stack-development'
                ])->get();
            }

            $learningPath->courses()->sync($courses->pluck('id')->mapWithKeys(function ($id, $index) {
                return [$id => ['order' => $index + 1]];
            }));
        }
    }
}
