<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
           [
    [
        'title' => 'Web Development Fundamentals',
        'description' => 'Learn the basics of web development including HTML, CSS, and JavaScript.',
        'difficulty_level' => 'beginner',
        'duration_in_hours' => 20,
        'prerequisites' => [],
        'skills_covered' => ['HTML', 'CSS', 'JavaScript'],
        'is_featured' => true,
        'image_url' => 'https://media.geeksforgeeks.org/wp-content/cdn-uploads/20210917204112/Top-10-Advance-Python-Concepts-That-You-Must-Know.png'
    ],
    [
        'title' => 'Advanced Python Programming',
        'description' => 'Master Python programming with advanced concepts and real-world projects.',
        'difficulty_level' => 'intermediate',
        'duration_in_hours' => 30,
        'prerequisites' => ['Basic Python'],
        'skills_covered' => ['Python', 'Data Structures', 'Algorithms'],
        'is_featured' => true,
        'image_url' => 'https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
    ],
    [
        'title' => 'Machine Learning Essentials',
        'description' => 'Introduction to machine learning concepts and practical applications.',
        'difficulty_level' => 'advanced',
        'duration_in_hours' => 40,
        'prerequisites' => ['Python', 'Statistics'],
        'skills_covered' => ['Machine Learning', 'Data Science', 'Python'],
        'is_featured' => true,
        'image_url' => 'https://images.pexels.com/photos/8386440/pexels-photo-8386440.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=700'
    ],
    [
        'title' => 'Mobile App Development with React Native',
        'description' => 'Build cross-platform mobile applications using React Native.',
        'difficulty_level' => 'intermediate',
        'duration_in_hours' => 25,
        'prerequisites' => ['JavaScript', 'React'],
        'skills_covered' => ['React Native', 'Mobile Development', 'JavaScript'],
        'is_featured' => false,
        'image_url' => 'https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=700'
    ],
    [
        'title' => 'Cloud Computing with AWS',
        'description' => 'Learn cloud computing concepts and AWS services.',
        'difficulty_level' => 'intermediate',
        'duration_in_hours' => 35,
        'prerequisites' => ['Basic Networking'],
        'skills_covered' => ['AWS', 'Cloud Computing', 'DevOps'],
        'is_featured' => true,
        'image_url' => 'https://images.pexels.com/photos/8386422/pexels-photo-8386422.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=700'
    ]
]

        ];

        foreach ($courses as $course) {
            $slug = Str::slug($course['title']);
            Course::firstOrCreate(
                ['slug' => $slug],
                array_merge($course, ['slug' => $slug])
            );
        }
    }
} 