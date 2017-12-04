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

    {!! Form::open(['url' => '/admin/social-media', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('image_url', 'Image_url') !!}
            {!! Form::file('image_url', null, ['accept' => 'image/*']) !!}
        </div>
        {!! Form::submit('Create', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
    <!-- this is the cancel button to cancel if you misclicked returns to social media screen -->
    <a href="/admin/social-media/" class="btn btn-info"> Cancel</a>
@endsection
