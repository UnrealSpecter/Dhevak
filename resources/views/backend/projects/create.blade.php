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

    {!! Form::open(['url' => '/admin/projects', 'enctype' => 'multipart/form-data']) !!}
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
        <h1>Roles:</h1>
        @foreach($roles as $role)
        <div class="form-group">
            {!! Form::label('role', $role->name) !!}
            {!! Form::checkbox('role[]', $role->id, false, ['class' => 'form-control']) !!}
        </div>
        @endforeach
        <div class="form-group image-upload">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url', null, ['accept' => 'image/*']) !!}
        </div>
        {!! Form::submit('Create', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}

    <script>
        // $('#image_url').get(0).onload = function(){
        //     alert('hallo');
        // }
        // if(document.getElementById("uploadBox").value != "") {
        // // you have a file
        // }

        var fileInput = $('#image_url').get(0);
        var formGroup = $('.image-upload');
        var clone = formGroup.clone();

        window.onload = function () {
            //attach first change handler to first input
            attachOnChangeHandler(fileInput);
        };

        function attachOnChangeHandler(element){
            element.onchange = function () {
                console.log('onchange fired');
                appendNewFileInput(this);
            };
        }

        function appendNewFileInput(element){
            var lastElement = $('.image-upload').last();
            clone.insertAfter(lastElement);
            attachOnChangeHandler(element);
        }

    </script>
@endsection
