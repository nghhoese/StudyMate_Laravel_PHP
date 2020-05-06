<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Module;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $modules = Module::all();
        return view('admin.teacher.create', ['modules' => $modules]);
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $validatedData = $request->validate([
            'name' => 'required|max:50'
        ]);
        $teacher = new Teacher();
        $teacher->name = request('name');


        $teacher->save();

        return redirect('/admin-dashboard');
    }

    public function delete(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $teacher = Teacher::find($id);
        $teacher->delete();



        return redirect('/admin-dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $validatedData = $request->validate([
            'name' => 'required|max:50'
        ]);
        $teacher = Teacher::find($id);
        $teacher->name = request('name');
        $modules = $request->modules;

        $teacher->save();
        return redirect('/admin-dashboard');
    }

    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $teacher = Teacher::find($id);

        return view('admin.teacher.edit', ['teacher' => $teacher]);
    }
}
