<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Module;
use App\Assignment;
use App\Tag;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $orderColumn = null,$ascdesc = null)
    {
        $request->user()->authorizeRoles(['user']);
        $teachers = Teacher::all();
        $modules = Module::all();
        if ($orderColumn != null && $ascdesc != null) {
            switch ($orderColumn) {
                case"name":
                    $deadlines = Assignment::orderBy('name', strtoupper($ascdesc))->get();
                    break;
                case"category":
                    $deadlines = Assignment::join('categories as po', 'po.id', '=', 'assignments.category_id')->whereNotNull('deadline')->orderBy('po.name', strtoupper($ascdesc))->select('assignments.*')->get();
                    break;
                case"module":
                    $deadlines = Assignment::join('modules as po', 'po.id', '=', 'assignments.module_id')->whereNotNull('deadline')->orderBy('po.name', strtoupper($ascdesc))->select('assignments.*')->get();
                    break;
                case"teacher":
                    $deadlines = Assignment::join('teachers as po', 'po.id', '=', 'assignments.teacher_id')->whereNotNull('deadline')->orderBy('po.name', strtoupper($ascdesc))->select('assignments.*')->get();
                    break;
                case"deadline":
                $deadlines = Assignment::whereNotNull('deadline')->orderBy($orderColumn, strtoupper($ascdesc))->get();
                break;
                    default:
                    return redirect('/deadline-dashboard');
                    break;
            }
        } else {
            $deadlines = Assignment::whereNotNull('deadline')->get();
        }

        return view('deadline/dashboard', ['teachers' => $teachers, 'modules' => $modules, 'deadlines' => $deadlines]);
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['user']);
        $assignments = Assignment::whereNull('deadline')->get();
        $tags = Tag::all();
        return view('deadline/create', ['tags' => $tags, 'assignments' => $assignments]);
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['user']);
        $validatedData = $request->validate([
            'deadline' => 'required|date'
        ]);

        $assignment = Assignment::find(request('selectedAssignment'));
        $assignment->deadline = request('deadline');
        $assignment->save();
        return redirect('/deadline-dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['user']);
        $assignment = Assignment::find($id);
        $assignment->deadline = request('deadline');
        $tags = $request->tags;
        $assignment->tag()->detach();
        if ($tags != null) {

            foreach ($tags as $tag) {
                $assignment->tag()->attach(Tag::where('name', $tag)->first());
            }
        }

        $assignment->save();
        return redirect('/deadline-dashboard');
    }
    public function updateAchieve(Request $request ){
        $request->user()->authorizeRoles(['user']);
        $assignments = \App\Assignment::all();

        foreach($assignments as $assignment){
            $assignment->achieved = 0;
            $assignment->save();
        }
        $deadlines = $request->checked;
        if ($deadlines != null) {

            foreach ($deadlines as $deadline) {
               $assignment = Assignment::find($deadline);
               $assignment->achieved = 1;
               $assignment->save();
            }
        }
        return redirect('/deadline-dashboard');


    }
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['user']);
        $assignment = Assignment::find($id);

        if($assignment == null){
             return redirect('/deadline-dashboard');
        }
             $tags = Tag::all();
        $date =  date("Y-m-d\TH:i", strtotime($assignment->deadline));
        $tags2 = array();

        foreach ($tags as $tag) {
            $found = false;
            foreach ($assignment->tag as $assignmentTag) {
                if ($tag->id == $assignmentTag->id) {
                    $found = true;
                }
            }
            if ($found == false) {
                array_push($tags2, $tag);
            }
        }
        return view('deadline.edit', ['assignment' => $assignment, 'tags' => $tags2, 'date' => $date]);
    }

    public function delete(Request $request, $id)
    {
        $request->user()->authorizeRoles(['user']);
        $assignment = Assignment::find($id);
        $assignment->deadline = null;
        $assignment->tag()->detach();
        $assignment->save();
        return redirect('/deadline-dashboard');
    }

}
