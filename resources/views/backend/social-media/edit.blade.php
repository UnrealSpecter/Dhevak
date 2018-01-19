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

    {!! Form::model($socialMedia, ['method' => 'PUT', 'route' => ['social-media.update', $socialMedia->id], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
        <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, [
          'class' => 'form-control',
          'placeholder' => 'name',
          'required',
          'data-parsley-required-message' => 'Name is required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        </div>
        <img class="img-responsive" src="{{ URL::asset('/uploads/social-media/' . $socialMedia->image_url) }}" />
        <div class="form-group">
          {!! Form::label('image_url', 'image') !!}
          {!! Form::file('image_url', ['class' => 'form-control btn btn-default btn-file',
          'data-parsley-required-message' => "image required",
          'data-parsley-max-file-size' => '1',
          'data-parsley-trigger' => "change"
          ]) !!}
          {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
        {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@endsection
