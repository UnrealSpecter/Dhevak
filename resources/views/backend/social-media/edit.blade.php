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

    {!! Form::model($socialMedia, ['method' => 'PUT', 'route' => ['social-media.update', $socialMedia->id], 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <img class="img-responsive" src="{{ URL::asset('/uploads/social-media/' . $socialMedia->image_url) }}" />
        <div class="form-group">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url', null, ['accept' => 'image/*']) !!}
        </div>
        {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@endsection
