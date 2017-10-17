@extends('backend.layout')

@section('content')
    <h1>Role</h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Title</th>
                <th>{{$project->title}}</th>
            </tr>
            <tr>
                <th>Description</th>
                <th>{{$project->description}}</th>
            </tr>
            <tr>
                <th>Project Website</th>
                <th>{{$project->project_url}}</th>
            </tr>
            <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
            @foreach($project->roles as $role)
            <tr>
                <th>Role</th>
                <th>{{$role->name}}</th>
            </tr>
            @endforeach
            <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
            @foreach($project->social_media as $medium)
            <tr>
                <th>Social Media</th>
                <th>{{$medium->name}}</th>
            </tr>
            @endforeach
            @foreach($project->images as $image)
            <!-- <tr>
                <th>Image</th>
                <th><img src="{{ URL::asset('/uploads/images/' . $image->image_url) }}"</th>
            </tr> -->
            @endforeach
        </table>
        <a href="/admin/projects/{{$project->id}}/edit" class="btn btn-info">Edit</a>
        {{ Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) }}
            {{ Form::hidden('id', $project->id) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    </div>
@endsection
