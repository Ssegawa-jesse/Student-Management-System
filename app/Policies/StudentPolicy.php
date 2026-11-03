<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    public function view(User $user, Student $student): bool
    {
        return $user->can('manage students') || $student->user_id === $user->id;
    }

    public function update(User $user, Student $student): bool
    {
        return $user->can('manage students');
    }

    public function delete(User $user, Student $student): bool
    {
        return $user->can('manage students');
    }
}
