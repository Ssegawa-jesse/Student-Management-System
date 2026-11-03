<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewStudents(User $user, Course $course): bool
    {
        if ($user->can('manage courses')) {
            return true;
        }

        return $user->can('view course students') && $course->lecturer_id === $user->id;
    }
}