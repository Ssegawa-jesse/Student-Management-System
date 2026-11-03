<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Order matters: roles → programmes → users (+ students & lecturers) → courses → registrations.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            CourseRegistrationSeeder::class,
        ]);
    }
}
