<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\Lesson;
use App\Models\CourseReview; // Import the CourseReview model
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Create Permissions
        $permissions = [
            'view role', 'create role', 'update role', 'delete role',
            'view permission', 'create permission', 'update permission', 'delete permission',
            'view user', 'create user', 'update user', 'delete user',
            'view task', 'create task', 'update task', 'delete task',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Step 2: Create Categories
        $categories = Category::factory()
            ->count(5) // Create 5 categories
            ->create();

        $roles = [
            'super-admin', 'admin', 'mentor', 'student'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Step 3: Create Users and Assign Roles

        // Super Admin
        User::factory()->create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('87654321'),
        ])->assignRole('super-admin');

        // Admin
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('87654321'),
        ])->assignRole('admin');

        // Mentors and their Courses
        $mentors = User::factory()
            ->count(3)
            ->has(Mentor::factory()) // Create mentor profiles
            ->create();

        foreach ($mentors as $mentor) {
            // Create courses for each mentor
            $courses = Course::factory()
                ->count(3) // Create 3 courses per mentor
                ->for($mentor->mentor) // Associate with the mentor
                ->state(function () use ($categories) {
                    return [
                        'category_id' => $categories->random()->id, // Assign a random category
                    ];
                })
                ->create();

            // Create chapters, lessons, and attach students to courses
            $courses->each(function ($course) {
                // Create chapters for each course
                $chapters = CourseChapter::factory()
                    ->count(3) // Create 3 chapters for each course
                    ->create(['course_id' => $course->id]);

                // Create lessons for each chapter
                $chapters->each(function ($chapter) {
                    Lesson::factory()
                        ->count(2) // Create 2 lessons for each chapter
                        ->create(['course_chapter_id' => $chapter->id]);
                });

                // Attach students to each course with the pivot data (commission, status, etc.)
                $students = User::factory()
                    ->count(5) // Create 5 students per course
                    ->create();

                // Attach students to course with commission and status
                $students->each(function ($student) use ($course) {
                    $student->courses()->attach($course->id, [
                        'status' => ['pending', 'received'][array_rand(['pending', 'received'])],
                        'commission' => 10,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                });

                // Create reviews for the course (if you want to generate reviews)
                CourseReview::factory()
                    ->count(3) // Generate 3 reviews for each course
                    ->create([
                        'course_id' => $course->id, // Link review to the current course
                    ]);
            });
        }

        // Students with Enrolled Courses (if you want students with pre-attached courses)
        User::factory()
            ->count(10)
            ->hasAttached(
                Course::factory()->count(3),
                [
                    'status' => ['pending', 'received'][array_rand(['pending', 'received'])],
                    'commission' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            )
            ->create()
            ->each(function ($student) {
                $student->assignRole('student');
            });
    }
}
