@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add an Assignment</h1>
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
                <form method="post" action="/assignment/store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="name">Description:</label>
                        <input type="text" class="form-control" name="description"/>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category:</label>
                        <select class="form-control" id="selectedCategory" name="selectedCategory">
                            <option value="">None</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Teacher:</label>
                        <select class="form-control" id="selectedTeacher" name="selectedTeacher">
                            <option value="">None</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Module:</label>
                        <select class="form-control" id="selectedModule" name="selectedModule">
                            <option value="">None</option>
                            @foreach($modules as $module)
                                <option value="{{$module->id}}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">EC:</label>
                        <input class="form-control" type="number" min="0" max="30" name="EC"/>
                    </div>

                    <div class="form-group">
                        <input type="file" name="file" class="form-control">
                    </div>

                    <button name="save-assignment" type="submit" class="btn btn-outline-success">Add</button>

                </form>
            </div>
        </div>
    </div>
@endsection
