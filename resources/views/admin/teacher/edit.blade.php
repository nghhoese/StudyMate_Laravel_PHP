@extends('layouts.app')

@section('content')

    <div class="card uper">
        <div class="card-header">
            Edit Teacher
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

            <form method="post" action="/teacher/update/{{$teacher->id}}">
                @csrf
                <div class="form-group">
                    <label for="name">Teacher Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" />
                </div>

                <br>
                <button name="update" type="submit" class="btn btn-outline-success">Update</button>
            </form>

        </div>
    </div>
@endsection
