@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a Module</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="/module/store">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="name">Which teachers teach this module:</label><br>
                        @foreach($teachers as $teacher)
                            <input type="checkbox" id="{{ $teacher->name }}" name="teachers[]" value="{{ $teacher->id }}">
                            <label for="{{ $teacher->name }}">{{ $teacher->name }}</label><br>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Who coordinates this module?</label>
                        <select class="form-control" id="selectedCoordinator" name="selectedCoordinator">
                            <option value="">Noone yet</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                            @endforeach


                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Block:</label>
                        <select class="form-control" id="selectedBlock" name="selectedBlock">
                            <option value="">None</option>
                            @foreach($blocks as $block)
                                <option value="{{$block->name}}">{{ $block->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect1">EC:</label>
                        <input class="form-control" type="number" min="1" max="30" name="ecValue"/>
                    </div>
                    <button name="save" type="submit" class="btn btn-outline-success">Add</button>

                </form>
            </div>
        </div>
    </div>
@endsection
