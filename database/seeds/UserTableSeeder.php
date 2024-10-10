<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Instructor;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $role_student = Role::where('name', 'student')->first();
    $role_instructor  = Role::where('name', 'instructor')->first();
    $role_admin  = Role::where('name', 'admin')->first();

    $is_exist = User::all();

    if (!$is_exist->count()) {
        $student = new User();
        $student->first_name = 'Judes';
        $student->last_name = 'Suares';
        $student->email = 'student@gmail.com';
        $student->password = bcrypt('iloveyou');
        $student->is_active = 1;
        $student->save();
        $student->roles()->attach($role_student);

        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'A';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('iloveyou');
        $admin->is_active = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);


        //import instructors
        $instructor_user = new User();
        $instructor_user->first_name = 'Gabriel';
        $instructor_user->last_name = 'Gestosani';
        $instructor_user->email = 'instructor@gmail.com';
        $instructor_user->password = bcrypt('iloveyou');
        $instructor_user->is_active = 1;
        $instructor_user->save();
        $instructor_user->roles()->attach($role_student);
        
        $instructor = new Instructor();
        $instructor->user_id = $instructor_user->id;
        $instructor->first_name = 'Gabriel';
        $instructor->last_name = 'Gestosani';
        $instructor->instructor_slug = 'gabriel-gestosani';
        $instructor->contact_email = 'instructor@gmail.com';
        $instructor->telephone = '123-54323';
        $instructor->mobile = '+639123456781';
        $instructor->paypal_id = 'instructor@gmail.com';
        $instructor->biography = '<p>LMS is a complete package script for setting up online courses and earn by enrolling students. The bundle includes responsive frontend website managed by full-fledge dashboard for Admin, Teachers and Students.</p>';
        $instructor->instructor_image = 'instructor/1/angela.jpg';
        $instructor->save();
        $instructor_user->roles()->attach($role_instructor);

        
    }
  }
}