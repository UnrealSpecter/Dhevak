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

    {!! Form::open(['url' => '/admin/roles', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Create', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
    <!-- this is the cancel button to cancel if you misclicked returns to images screen -->
    <a href="/admin/images/" class="btn btn-info"> Cancel</a>
@endsection
