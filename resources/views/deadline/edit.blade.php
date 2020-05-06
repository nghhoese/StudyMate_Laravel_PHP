@extends('layouts.app')

@section('content')



    <div class="card uper">
        <div class="card-header">
            Edit Deadline
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
            <form method="post" action="/deadline/update/{{$assignment->id}}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tags: </label>
                    <br>
                    @foreach($assignment->tag as $tag1)
                    <input type="checkbox" checked id="{{ $tag1->name }}" name="tags[]" value="{{ $tag1->name }}">
                        <label for="{{ $tag1->name }}">{{ $tag1->name }}</label><br>
                    @endforeach
                    @foreach($tags as $tag)
                        <input type="checkbox" id="{{ $tag->name }}" name="tags[]" value="{{ $tag->name }}">
                        <label for="{{ $tag->name }}">{{ $tag->name }}</label><br>
                    @endforeach
                </div>


                <div class="form-group">
                        <label>Deadline: </label>
                        <input name="deadline" id="deadline" type="datetime-local" value="{{$date}}"/>
                    </div>

                <br>
                <button name="save-deadline" type="submit" class="btn btn-outline-success">Update</button>
            </form>
        </div>
    </div>

@endsection
