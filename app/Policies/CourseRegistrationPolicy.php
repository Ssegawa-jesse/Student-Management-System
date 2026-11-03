<?php

namespace App\Policies;

use App\Models\CourseRegistration;
use App\Models\User;

class CourseRegistrationPolicy
{
    public function delete(User $user, CourseRegistration $registration): bool
    {
        if ($user->can('manage registrations')) {
            return true;
        }

        return $registration->student?->user_id === $user->id;
    }
}
