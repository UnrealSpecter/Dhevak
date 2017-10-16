@extends('backend.layout')

@section('content')
    <h1>Role</h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Title</th>
                <th>{{$project->name}}</th>
            </tr>
            <tr>
                <th>Description</th>
                <th>{{$project->description}}</th>
            </tr>
            <tr>
                <th>Project Website</th>
                <th>{{$project->project_url}}</th>
            </tr>
        </table>
        <a href="/admin/projects/{{$project->id}}/edit" class="btn btn-info">Edit</a>
        {{ Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) }}
            {{ Form::hidden('id', $project->id) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    </div>
@endsection
