@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a Deadline</h1>
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
                <form method="post" action="/deadline/store">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Assignment: </label>
                        <br>

                        <select class="form-control" id="selectedAssignment" name="selectedAssignment">
                            @foreach($assignments as $assignment)
                                <option value="{{$assignment->id}}">{{ $assignment->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tags: </label>
                        <br>

                    @foreach($tags as $tag)
                                <input type="checkbox" id="{{ $tag->name }}" name="tags[]" value="{{ $tag->name }}">
                                <label for="{{ $tag->name }}">{{ $tag->name }}</label><br>
                            @endforeach
                    </div>


                    <div class="form-group">
                        <label>Deadline: </label>
                        <input id="deadline" name="deadline" type="datetime-local"/>
                    </div>

                    <button name="save-deadline" type="submit" class="btn btn-outline-success">Add</button>

                </form>
            </div>
        </div>
    </div>
@endsection
