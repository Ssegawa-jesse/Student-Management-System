<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public const PASSWORD = '12345678';

    public const USERS = [
        ['name' => 'System Administrator', 'email' => '2400725284@mubs.ac.ug', 'role' => 'admin'],
        ['name' => 'Dr. Moses Kato', 'email' => 'moses.kato@sms.test', 'role' => 'lecturer'],
        ['name' => 'Ms. Ruth Atim', 'email' => 'ruth.atim@sms.test', 'role' => 'lecturer'],
        ['name' => 'Sarah Nakato', 'email' => 'sarah.nakato@students.sms.test', 'role' => 'student'],
        ['name' => 'John Okello', 'email' => 'john.okello@students.sms.test', 'role' => 'student'],
        ['name' => 'Aisha Namuli', 'email' => 'aisha.namuli@students.sms.test', 'role' => 'student'],
        ['name' => 'Kevin Mugabi', 'email' => 'kevin.mugabi@students.sms.test', 'role' => 'student'],
        ['name' => 'Patience Achan', 'email' => 'patience.achan@students.sms.test', 'role' => 'student'],
    ];

    public function run(): void
    {
        foreach (self::USERS as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make(self::PASSWORD),
                ]
            );

            $user->syncRoles([$data['role']]);
        }
    }
}
