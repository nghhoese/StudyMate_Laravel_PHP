<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Module;
use App\Category;
use App\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $modules = Module::all();
        $categories = Category::all();
        $teachers = Teacher::all();
        return view('admin.assignment.create',['modules' => $modules, 'categories' => $categories, 'teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $request->validate([
            'file' => 'mimes:pdf,xlx,csv,zip|max:12048',
            'name' => 'required|max:50',
            'description' => 'required|max:500',
            'selectedModule' => 'required',
            'selectedCategory' => 'required',
            'selectedTeacher' => 'required',
        ]);

        $assignment = new Assignment();
        if($request->file != null) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('uploads'), $fileName);
            $assignment->file = $fileName;
        }
        $assignment->teacher_id = request('selectedTeacher');
        $assignment->name = request('name');
        $assignment->description = request('description');
        $assignment->module_id = request('selectedModule');
        $assignment->category_id = request('selectedCategory');
        $assignment->EC = request('EC');
        $assignment->save();
        return redirect('/admin-dashboard');
    }

    public function delete(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $assignment = Assignment::find($id);
        $assignment->delete();
        return redirect('/admin-dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $request->validate([
            'file' => 'mimes:pdf,xlx,csv,zip|max:12048',
            'name' => 'required|max:50',
            'description' => 'required|max:500',
            'selectedModule' => 'required',
            'selectedCategory' => 'required',
            'selectedTeacher' => 'required',
        ]);
        $assignment = Assignment::find($id);
        $assignment->name = request('name');
        $assignment->description = request('description');
        $assignment->module_id = request('selectedModule');
        $assignment->category_id = request('selectedCategory');
        $assignment->grade = request('grade');
        $assignment->EC = request('EC');
        $assignment->teacher_id = request('selectedTeacher');
        if ($request->file != null) {

        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $fileName);
        $assignment->file = $fileName;
        }
        $assignment->save();
        return redirect('/admin-dashboard');
    }

    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $assignment = Assignment::find($id);
        $modulesWithoutModule = Module::where('id', '!=', $assignment->module_id)->get();
        $teachersWithoutTeacher = Teacher::where('id', '!=', $assignment->teacher_id)->get();
        $categoriesWithoutCategory = Category::where('id', '!=', $assignment->category_id)->get();
        return view('admin.assignment.edit', ['teachersWithoutTeacher' => $teachersWithoutTeacher, 'assignment' => $assignment,  'modules' => $modulesWithoutModule, 'categoriesWithoutCategory' => $categoriesWithoutCategory]);
    }
}
