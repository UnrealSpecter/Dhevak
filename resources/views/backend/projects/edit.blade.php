@extends('backend.layout')

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($project, ['method' => 'PUT', 'route' => ['projects.update', $project->id], 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('project_url', 'Project_url') !!}
            {!! Form::text('project_url', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@endsection
