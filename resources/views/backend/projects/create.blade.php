@extends('backend.layout')

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/backend/projects/script.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/backend/projects/style.css">
@endsection

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

    {!! Form::open(['url' => '/admin/projects', 'enctype' => 'multipart/form-data']) !!}
        <h1> Create Project </h1>
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
        <div class="form-group">
            <h1>Roles:</h1>
        </div>
        @foreach($roles as $role)
            <div class="form-group">
                {!! Form::label('role', $role->name) !!}
                {!! Form::checkbox('role[]', $role->id, false, ['class' => 'form-control']) !!}
            </div>
        @endforeach
        <div class="form-group">
            <h1>Images:</h1>
        </div>
        <div class="form-group image-upload">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url[]', ['id' => 'image_url', 'accept' => 'image/*']) !!}
        </div>
        <div class="form-group">
            <h1>Social Media:</h1>
        </div>
        @foreach($socialMedia as $medium)
            <div class="form-group">
                {!! Form::label('socialMedia', $medium->name) !!}
                <div class="flex">
                {!! Form::checkbox('socialMedia[]', $medium->id, false, ['class' => 'form-control no-margin checkbox']) !!}
                </div>
            </div>



        @endforeach
        {!! Form::submit('Create', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}

@endsection
