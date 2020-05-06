@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">EC Progress:
                        <div>
                            <div class="progress-border">
                                <div class="progress-bar" style="height:24px;width:{{$progress}}%;">
                                    {{$progress}}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modules:</div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Block</th>
                            <th>Name</th>
                            <th>Average Grade</th>
                            <th>Assignments</th>
                            <th>EC</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $module)
                            <tr>
                                <td>{{$module->block->semester_name ?? ''}}</td>
                                <td>{{$module->block_name}}</td>
                                <td>{{$module->name}}</td>
                                <td>
                                    <label>{{$module->assignment->avg('grade')}}</label>
                                </td>

                                <td>@foreach($module->assignment as $assignment)
                                        {{$assignment->name}}: {{$assignment->grade ?? "N/A"}} <br>
                                    @endforeach
                                </td>
                                <td>{{$module->assignment->sum('EC')}} / {{$module->EC}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">EC:</div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Block</th>
                            <th>EC</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blocks as $block)
                            <tr>
                                <td>{{$block->name ?? ''}}</td>
                                <td>{{$block->getAllEC()}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <b>Total:</b>
                            </td>
                            <td>
                               <b>{{$totalEC}}</b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
