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

    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
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
        {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@endsection
