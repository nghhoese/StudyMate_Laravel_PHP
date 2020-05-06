<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Module;
use App\Assignment;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $teachers = Teacher::all();
        $modules = Module::all();
        $assignments = Assignment::all();

        return view('admin/dashboard', ['teachers' => $teachers, 'modules' => $modules, 'assignments' => $assignments]);
    }
}
