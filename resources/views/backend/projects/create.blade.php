@extends('backend.layout')
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>

<script src="http://parsleyjs.org/dist/parsley.min.js"></script>



<script>

  $('#form').parsley();
</script>

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

    {!! Form::open(['url' => '/admin/projects', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
        <h1> Create Project </h1>
        <div class="form-group">
            @if($verticalProject)
                <h1>Please upload a VERTICAL Thumbnail: </h1>
            @else
                <h1>Please upload a HORIZONTAL Thumbnail: </h1>
            @endif
        </div>
        <div class="form-group">
          {!! Form::label('thumbnail_image_url', 'image') !!}
          {!! Form::file('thumbnail_image_url', ['class' => 'form-control btn btn-default btn-file',
          'required',
          'data-parsley-required-message' => "image required",
          'data-parsley-max-file-size' => '1',
          'data-parsley-trigger' => "change"
          ]) !!}
          {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, [
            'class' => 'form-control',
            'placeholder' => 'title',
            'required',
            'data-parsley-required-message' => 'title is required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('project_url', 'Project_url') !!}
            {!! Form::text('project_url', null, [
            'class' => 'form-control',
            'placeholder' => 'url',
            'required',
            'data-parsley-required-message' => 'url is required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
        </div>
        <h1>Project Description</h1>
        <div class="form-group project_description">
            {!! Form::label('project_description', 'Project_description') !!}
            {!! Form::textarea('project_description[]', null, [
            'class' => 'form-control',
            'maxlength' => '450',
            'required',
            'data-parsley-required-message' => 'pls gib us description',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <button type="button" class="btn btn-primary add-project-description">Add Another Description</button>
        </div>
        <div class="form-group">
            <h1>Roles:</h1>
        </div>
        @foreach($roles as $role)
            <div class="form-group">
                {!! Form::label('role', $role->name) !!}
                {!! Form::checkbox('role[]', $role->id, false, ['class' => 'form-control',
                'required',
                'data-parsley-required-message' => "kies dr eenje jong",
                'data-parsley-trigger' => "change"
                ]) !!}
            </div>
        @endforeach
        <div class="form-group">
            <h1>Images:</h1>
        </div>
        <div class="form-group image-upload">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url[]', ['id' => 'image_url', 'accept' => 'image/*',
            'class' => 'form-control btn btn-default btn-file',
            'data-parsley-required-message' => "image required",
            'data-parsley-max-file-size' => '1',
            'data-parsley-trigger' => "change"
            ]) !!}
            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}

        </div>
        <div class="form-group">
            <h1>Social Media:</h1>
        </div>
        @foreach($socialMedia as $medium)
            <div class="form-group">
                {!! Form::label('socialMedia', $medium->name) !!}
                <div class="flex">
                {!! Form::checkbox('socialMedia[]', $medium->id, false, ['class' => 'form-control no-margin checkbox', 'required', 'data-parsley-required-message' => "url required",  ]) !!}
                </div>
          </div>
        @endforeach
        {!! Form::submit('Create', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
    <!-- this is the cancel button to cancel if you misclicked returns to projects screen -->
    <a href="/admin/projects/" class="btn btn-info"> Cancel</a>

@endsection
