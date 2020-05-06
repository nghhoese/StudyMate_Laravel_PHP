@extends('layouts.app')

@section('content')

    <div class="card uper">
        <div class="card-header">
            Edit Module
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form dusk="module-form" method="post" action="/module/update/{{$module->id}}">
                @csrf
                <div class="form-group">
                    <label for="name">Module Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $module->name }}"/>
                </div>

                <div class="form-group">
                    <label for="name">Which teachers teach this module:</label>
                    <br>
                    @foreach($module->teacher()->get() as $moduleTeacher)
                        <input type="checkbox" checked id="{{ $moduleTeacher->name }}" name="teachers[]" value="{{ $moduleTeacher->id }}">
                        <label for="{{ $moduleTeacher->name }}">{{ $moduleTeacher->name }}</label><br>
                    @endforeach
                    @foreach($teachers as $teacher)
                        <input type="checkbox" id="{{ $teacher->name }}" name="teachers[]" value="{{ $teacher->id }}">
                        <label for="{{ $teacher->name }}">{{ $teacher->name }}</label><br>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Who coordinates this module?</label>
                    <select class="form-control" id="selectedCoordinator" name="selectedCoordinator">
                        <option value="{{ $module->coordinator ?? '' }}">{{ $module->teacher()->find($module->coordinator)->name ?? '' }}</option>
                        @foreach($teachersWithoutCoordinator as $teacher)
                            <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Who teaches this module to you?</label>
                    <select class="form-control" id="selectedTeacher" name="selectedTeacher">
                        <option value="{{ $module->teacher ?? ''}}">{{ $module->teacher()->find($module->teacher)->name ?? ''}}</option>
                        @foreach($teachersWithoutTeacher1 as $teacher)
                            <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Block:</label>
                    <select class="form-control" id="selectedBlock" name="selectedBlock">
                        <option value="{{ $module->block_name}}">{{ $module->block_name ?? 'None'}}</option>
                        @foreach($blocksWithoutBlock as $block)
                            <option value="{{$block->name}}">{{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Achieved:</label><br>
                    @if($module->achieved == 1)
                        <input type="checkbox" checked id="{{ $module->achieved }}" name="achieved[]">
                        @else
                    <input type="checkbox" id="{{ $module->achieved }}" name="achieved[]">
                        @endif
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">EC:</label>
                    <input value="{{$module->EC}}" class="form-control" type="number" min="1" max="30" name="ecValue"/>
                </div>

                <button name="save-module" type="submit" class="btn btn-outline-success">Update</button>
            </form>
        </div>
    </div>
@endsection
