@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Deadlines
                        <a href="/deadline/create" class="btn btn-outline-success">Add</a>
                        <a href="/deadline-dashboard" class="btn btn-outline-warning">Reset filters</a>
                    </div>


                    <div class="card-body">
                    <form method="post" action="/deadline/updateAchieve">
                    @csrf
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name <br><a href="/deadline-dashboard/name/asc"><i class="fas fa-angle-up"></i></a><a href="/deadline-dashboard/name/desc"><i class="fas fa-angle-down"></i></a></th>
                                <th>Module <br><a href="/deadline-dashboard/module/asc"><i class="fas fa-angle-up"></i></a><a href="/deadline-dashboard/module/desc"><i class="fas fa-angle-down"></i></a></th>
                                <th>Teacher <br><a href="/deadline-dashboard/teacher/asc"><i class="fas fa-angle-up"></i></a><a href="/deadline-dashboard/teacher/desc"><i class="fas fa-angle-down"></i></a></th>
                                <th>Deadline <br><a href="/deadline-dashboard/deadline/asc"><i class="fas fa-angle-up"></i></a><a href="/deadline-dashboard/deadline/desc"><i class="fas fa-angle-down"></i></a></th>
                                <th>Category <br><a href="/deadline-dashboard/category/asc"><i class="fas fa-angle-up"></i></a><a href="/deadline-dashboard/category/desc"><i class="fas fa-angle-down"></i></a></th>

                                <th>Tags</th>
                                <th>Achieved</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deadlines as $deadline)
                                <tr>
                                    <td>{{$deadline->name}}</td>
                                    <td>{{$deadline->module()->first()->name ?? "None"}}</td>
                                    <td>{{$deadline->teacher()->name ?? 'None'}}</td>
                                    <td>{{$deadline->deadline}}</td>
                                    <td>{{$deadline->category()->name ?? "None"}}</td>
                                    <td>@foreach($deadline->tag as $tag)
                                            {{$tag->name}},
                                        @endforeach
                                    </td>
                                    <td>
                                    @if($deadline->achieved == 1)
                                    <input type="checkbox" checked  id="{{ $deadline->id }}" name="checked[]" value="{{ $deadline->id }}">
                                    @else
                                    <input type="checkbox" id="{{ $deadline->id }}" name="checked[]" value="{{ $deadline->id }}">

                                    @endif


                                    </td>
                                    <td><a href="/deadline/edit/{{$deadline->id}}" class="btn btn-outline-primary">Edit</a>
                                    </td>
                                    <td><a href="/deadline/delete/{{$deadline->id}}" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
