<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Teacher;
use App\Module;
use App\Assignment;

class DeadlineTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeadline()
    {
        $this->browse(function (Browser $browser) {

            $randomNumber = rand(1000, 10000);
            $moduleName = "Module" . $randomNumber;
            $teacherName = "Teacher" . $randomNumber;
            $assignmentName = "Assignment".$randomNumber;

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
                ->assertSee($teacherName)
                ->pause(1000);

            $teachers = Teacher::all();
            foreach ($teachers as $teacher) {

                if ($teacher->name == $teacherName) {
                    $teacher_id = $teacher->id;
                    $teacher1 = $teacher;
                }
            }

            $browser->visit('http://studymate.com/module/create')
                ->assertSee('Add a Module')
                ->type('name', $moduleName)
                ->check("input[name='teachers[]']")
                ->select('selectedCoordinator', $teacher_id)
                ->select('selectedBlock', 'block 1')
                ->pause(2000)
                ->press('save')
                ->pause(1000)
                ->assertSee($moduleName);

            $module = Module::where('name', '=', $moduleName)->first();
            $module->teacher()->attach($teacher1);
            $module->save();
            $browser->visit('http://studymate.com/module/edit/' . $module->id)
                ->check("achieved[]")
                ->select('selectedTeacher', $teacher_id)
                ->press('save-module')
                ->pause(2000)
                ->visit('http://studymate.com/guest-dashboard')
                ->assertSee($moduleName)
                ->visit('http://studymate.com/assignment/create')
                ->assertSee('Add an Assignment')
                ->type('name', $assignmentName)
                ->type('description', 'testDescription')
                ->select('selectedCategory', 1)
                ->select('selectedTeacher', $teacher_id)
                ->select('selectedModule', $module->id)
                ->type('EC', 1)
                ->pause(1000)
                ->press('save-assignment')
                ->pause(3000)
                ->assertSee($assignmentName)
                ->pause(3000)
                ->visit('http://studymate.com/deadline/create')
                ->select('selectedAssignment', Assignment::where('name', '=', $assignmentName)->first()->id)
                ->type('deadline', "20")
                ->type('deadline', "05")
                ->type('deadline', "2020")
                ->keys('#deadline', ['{tab}'])
                ->type('deadline', '0104AM')
                ->pause(1000)
                ->press('save-deadline')
                ->pause(1000)
                ->assertSee($assignmentName);
        });
    }
    public function testAchieved()
    {
        $this->browse(function (Browser $browser) {

            $randomNumber = rand(1000, 10000);
            $moduleName = "Module" . $randomNumber;
            $teacherName = "Teacher" . $randomNumber;
            $assignmentName = "Assignment".$randomNumber;

            $browser
                ->visit('http://studymate.com/teacher/create')
                ->assertSee('Add Teacher')
                ->type('name', $teacherName)
                ->pause(2000)
                ->press('save')
                ->pause(1000)
                ->assertSee($teacherName)
                ->pause(1000);

            $teachers = Teacher::all();
            foreach ($teachers as $teacher) {

                if ($teacher->name == $teacherName) {
                    $teacher_id = $teacher->id;
                    $teacher1 = $teacher;
                }
            }

            $browser->visit('http://studymate.com/module/create')
                ->assertSee('Add a Module')
                ->type('name', $moduleName)
                ->check("input[name='teachers[]']")
                ->select('selectedCoordinator', $teacher_id)
                ->select('selectedBlock', 'block 1')
                ->pause(2000)
                ->press('save')
                ->pause(1000)
                ->assertSee($moduleName);

            $module = Module::where('name', '=', $moduleName)->first();
            $module->teacher()->attach($teacher1);
            $module->save();
            $browser->visit('http://studymate.com/module/edit/' . $module->id)
                ->check("achieved[]")
                ->select('selectedTeacher', $teacher_id)
                ->press('save-module')
                ->pause(2000)
                ->visit('http://studymate.com/guest-dashboard')
                ->assertSee($moduleName)
                ->visit('http://studymate.com/assignment/create')
                ->assertSee('Add an Assignment')
                ->type('name', $assignmentName)
                ->type('description', 'testDescription')
                ->select('selectedCategory', 1)
                ->select('selectedTeacher', $teacher_id)
                ->select('selectedModule', $module->id)
                ->type('EC', 1)
                ->pause(1000)
                ->press('save-assignment')
                ->pause(3000)
                ->assertSee($assignmentName)
                ->pause(3000)
                ->visit('http://studymate.com/deadline/create')
                ->select('selectedAssignment', Assignment::where('name', '=', $assignmentName)->first()->id)
                ->type('deadline', "20")
                ->type('deadline', "05")
                ->type('deadline', "2020")
                ->keys('#deadline', ['{tab}'])
                ->type('deadline', '0104AM')
                ->pause(1000)
                ->press('save-deadline')
                ->pause(1000)
                ->assertSee($assignmentName);

                $assignment_id = Assignment::where('name', '=', $assignmentName)->first()->id;


                $browser
                ->visit('http://studymate.com/deadline/edit/'.$assignment_id)
                 ->pause(2000)
                ->type('deadline', "20")
                ->type('deadline', "05")
                ->type('deadline', "2020")
                ->keys('#deadline', ['{tab}'])
                ->type('deadline', '0911AM')
                ->pause(1000)
                ->press('save-deadline')
                ->pause(1000)
                ->assertSee('09:11');
        });
    }
}
