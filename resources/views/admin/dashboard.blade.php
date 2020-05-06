@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Teachers <a href="/teacher/create" class="btn btn-outline-success">Add</a></div>

                    <div class="card-body">
                        @foreach($teachers as $teacher)
                            <h3>{{$teacher->name}}</h3>
                            <a href="/teacher/edit/{{ $teacher->id }}" class="btn btn-outline-primary">Edit</a>
                            <a href="/teacher/delete/{{$teacher->id}}" class="btn btn-outline-danger">Delete</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modules <a href="/module/create" class="btn btn-outline-success">Add</a></div>

                    <div class="card-body">
                        @foreach($modules as $module)
                            <h3>{{$module->name}}</h3>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=111x111&data={{$module->assignment}}" />
                            <a href="/module/edit/{{ $module->id }}" class="btn btn-outline-primary">Edit</a>
                            <a href="/module/delete/{{$module->id}}" class="btn btn-outline-danger">Delete</a>

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Assignments <a href="/assignment/create" class="btn btn-outline-success">Add</a></div>

                    <div class="card-body">
                        @foreach($assignments as $assignment)
                            <h3>{{$assignment->name}}</h3>

                            <a href="/assignment/edit/{{ $assignment->id }}" class="btn btn-outline-primary">Edit</a>
                            <a href="/assignment/delete/{{$assignment->id}}" class="btn btn-outline-danger">Delete</a>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
