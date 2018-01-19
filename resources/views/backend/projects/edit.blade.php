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

    {!! Form::model($project, ['method' => 'PUT', 'route' => ['projects.update', $project->id], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control',
            'placeholder' => 'name',
            'required',
            'data-parsley-required-message' => 'Name is required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
        </div>
        <!-- project = object has many Descriptions
        loop through project object collection of descriptions looking for a description
         form text description collection call to attribute content.
       -->
        @foreach($project->descriptions as $description)

        <div class="form-group">
            {!! Form::label('project_description[]', 'Description') !!}
            {!! Form::text('project_description[]', $description->content, ['class' => 'form-control',
            'placeholder' => 'name',
            'required',
            'data-parsley-required-message' => 'Name is required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
        </div>
        @endforeach

        <div class="form-group">
            {!! Form::label('project_url', 'Project_url') !!}
            {!! Form::text('project_url', null, ['class' => 'form-control',
            'placeholder' => 'name',
            'required',
            'data-parsley-required-message' => 'Name is required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
        </div>
        @foreach($project->roles as $role)
            <div class="form-group">
                {!! Form::label('role', $role->name) !!}
                {!! Form::checkbox('role[]', $role->id, false, ['class' => 'form-control',
                'data-parsley-required-message' => "kies dr eenje jong",
                'data-parsley-trigger' => "change",
                ]) !!}
            </div>
            @endforeach
        <img class="img-responsive" src="{{ URL::asset('/uploads/images/' . $project->thumbnail_image_url) }}" />
        <div class="form-group">
            {!! Form::label('thumbnail_image_url', 'thumbnail_image_url') !!}
            {!! Form::file('thumbnail_image_url', null, ['accept' => 'image/*',
            'data-parsley-required-message' => "image required",
            'data-parsley-max-file-size' => '1',
            'data-parsley-trigger' => "change",
            ]) !!}
        </div>
        @foreach($project->images as $image)
        <img class="img-responsive" src="{{ URL::asset('/uploads/images/' . $image->image_url) }}" />
        <div class="form-group">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url', null, ['accept' => 'image/*',
            'data-parsley-required-message' => "image required",
            'data-parsley-max-file-size' => '1',
            'data-parsley-trigger' => "change",
            ]) !!}
        </div>
        @endforeach

        {!! Form::submit('Update', ['class' => 'btn btn-info',]) !!}
    {!! Form::close() !!}
@endsection
