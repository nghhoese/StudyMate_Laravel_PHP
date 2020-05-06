<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Module;
use App\Block;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $teachers = Teacher::all();
        $blocks = Block::all();

        return view('admin.module.create', ['teachers' => $teachers, 'blocks' => $blocks]);
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $validatedData = $request->validate([
            'selectedCoordinator' => 'required|max:255',
            'teachers' => 'required',
            'name' => 'required|max:50',
            'selectedBlock' => 'required'
        ]);
        $module = new Module();
        $module->name = request('name');
        $module->coordinator = request('selectedCoordinator');
        $module->block_name = request('selectedBlock');
        $module->EC = request('ecValue');
        $teachers = $request->teachers;

        $module->save();
        if ($teachers != null) {

            foreach ($teachers as $teacher) {
                $module->teacher()->attach(Teacher::find($teacher));
            }
        }
        return redirect('/admin-dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $validatedData = $request->validate([
            'selectedCoordinator' => 'required|max:255',
            'selectedTeacher' => 'required',
            'teachers' => 'required',
            'name' => 'required|max:50',
            'selectedBlock' => 'required'
        ]);
        $module = Module::find($id);
        $module->name = request('name');
        $module->teacher = request('selectedTeacher');
        $module->coordinator = request('selectedCoordinator');
        $achieved = $request->achieved;
        if ($achieved != null) {
            $module->achieved = 1;
        } else{
            $module->achieved = 0;
        }

        $module->EC = request('ecValue');
        $teachers = $request->teachers;
        $module->teacher()->detach();
        $module->block_name = request('selectedBlock');
        if ($teachers != null) {
            foreach ($teachers as $teacher) {
                $module->teacher()->attach(Teacher::find($teacher));
            }
        }
        $module->save();
        return redirect('/admin-dashboard');
    }

    public function delete(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $module = Module::find($id);

        $module->delete();
        return redirect('/admin-dashboard');
    }

    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $module = Module::find($id);
        $teachers = Teacher::all();
        $teachersWithoutCoordinator = Teacher::where('id', '!=', $module->coordinator)->get();
        $teachersWithoutTeacher = Teacher::where('id', '!=', $module->teacher)->get();
        $blocksWithoutBlock = Block::where('name', '!=', $module->block)->get();
        $teachersWithoutTeacher1 = $module->teacher()->get();
        $teachers3 = array();
        foreach ($teachersWithoutTeacher1 as $teacher) {
            if ($teacher->id != $module->teacher) {
                array_push($teachers3, $teacher);
            }
        }

        $teachers2 = array();
        foreach ($teachers as $teacher) {
            $found = false;
            foreach ($module->teacher()->get() as $moduleTeacher) {
                if ($teacher->id == $moduleTeacher->id) {
                    $found = true;
                }
            }
            if ($found == false) {
                array_push($teachers2, $teacher);
            }
        }
        return view('admin.module.edit', ['module' => $module, 'teachers' => $teachers2, 'teachersWithoutCoordinator' => $teachersWithoutCoordinator, 'teachersWithoutTeacher1' => $teachers3, 'teachersWithoutTeacher' => $teachersWithoutTeacher, 'blocksWithoutBlock' => $blocksWithoutBlock]);
    }
}
