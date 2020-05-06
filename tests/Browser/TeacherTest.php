<?php

namespace Tests\Browser;

use App\Teacher;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TeacherTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testCreateTeacher()
    {
        $this->browse(function (Browser $browser) {
            $randomNumber = rand(1000, 10000);
            $teacherName = "Teacher".$randomNumber;
            $browser
                ->visit('http://studymate.com/login')
                ->type('email', 'admin@studymate.com')
                ->type('password', 'admin1234')
                ->press('login')
                ->pause(2000)
                ->visit('http://studymate.com/teacher/create')
                ->assertSee('Add Teacher')
                ->type('name', $teacherName)
                ->pause(2000)
                ->press('save')
                ->pause(1000)
                ->assertSee($teacherName);
        });
    }

    public function testEditTeacher()
    {
        $this->browse(function (Browser $browser) {
            $teacher_id = Teacher::first()->id;
            $randomNumber = rand(1000, 10000);
            $teacherName = "Teacher".$randomNumber;
            $browser
                ->visit('http://studymate.com/teacher/edit/'.$teacher_id)
                ->assertSee('Edit Teacher')
                ->type('name', $teacherName)
                ->pause(2000)
                ->press('update')
                ->pause(1000)
                ->assertSee($teacherName);
        });
    }
}
