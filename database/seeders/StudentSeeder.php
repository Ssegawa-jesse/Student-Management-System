<?php
 
namespace Database\Seeders;
 
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
 
/**
 * Question 2(a): at least five students.
 * updateOrCreate by registration_number = no duplicates when re-seeded.
 * Each student is linked to the user account made in UserSeeder (same email).
 */
class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['registration_number' => '24/U/0001', 'first_name' => 'Sarah', 'last_name' => 'Nakato', 'email' => 'sarah.nakato@students.sms.test', 'phone' => '0772410552', 'gender' => 'Female', 'date_of_birth' => '2004-03-14', 'programme' => 'Bachelor of Business Computing', 'year_of_study' => 3],
            ['registration_number' => '24/U/0002', 'first_name' => 'John', 'last_name' => 'Okello', 'email' => 'john.okello@students.sms.test', 'phone' => '0701556210', 'gender' => 'Male', 'date_of_birth' => '2003-08-02', 'programme' => 'Bachelor of Business Computing', 'year_of_study' => 3],
            ['registration_number' => '24/U/0003', 'first_name' => 'Aisha', 'last_name' => 'Namuli', 'email' => 'aisha.namuli@students.sms.test', 'phone' => '0755900118', 'gender' => 'Female', 'date_of_birth' => '2005-01-21', 'programme' => 'Bachelor of Information Technology', 'year_of_study' => 2],
            ['registration_number' => '24/U/0004', 'first_name' => 'Kevin', 'last_name' => 'Mugabi', 'email' => 'kevin.mugabi@students.sms.test', 'phone' => '0783001442', 'gender' => 'Male', 'date_of_birth' => '2004-11-09', 'programme' => 'Bachelor of Business Computing', 'year_of_study' => 3],
            ['registration_number' => '24/U/0005', 'first_name' => 'Patience', 'last_name' => 'Achan', 'email' => 'patience.achan@students.sms.test', 'phone' => '0772663019', 'gender' => 'Female', 'date_of_birth' => '2005-06-30', 'programme' => 'Bachelor of Information Technology', 'year_of_study' => 2],
        ];
 
        foreach ($students as $data) {
            $data['user_id'] = User::where('email', $data['email'])->value('id');
 
            Student::updateOrCreate(
                ['registration_number' => $data['registration_number']],
                $data
            );
        }
    }
}
