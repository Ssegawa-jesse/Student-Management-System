<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     * Anyone who registers becomes a STUDENT and gets a student profile.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:students,email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $user->assignRole('student');

            $parts = preg_split('/\s+/', trim($input['name']), 2);

            $user->student()->create([
                'registration_number' => 'SMS/'.now()->format('Y').'/'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                'first_name' => $parts[0],
                'last_name' => $parts[1] ?? '',
                'email' => $input['email'],
                'programme' => 'Not yet assigned',
                'year_of_study' => 1,
            ]);

            return $user;
        });
    }
}