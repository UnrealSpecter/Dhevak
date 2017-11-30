@extends('backend.layout')

@section('content')
    <h1>Social Media</h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Name:</th>
                <th>{{$socialMedia->name}}</th>
            </tr>
            <tr>
                <th>Image_url:</th>
                <th>{{$socialMedia->image_url}}</th>
            </tr>
        </table>
        <a href="/admin/social-media/{{$socialMedia->id}}/edit" class="btn btn-info">Edit</a>
        {{ Form::open(['method' => 'DELETE', 'route' => ['social-media.destroy', $socialMedia->id]]) }}
            {{ Form::hidden('id', $socialMedia->id) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
        <!-- this is the cancel button to cancel if you misclicked returns to social media screen -->
        <a href="/admin/social-media/" class="btn btn-info"> Cancel</a>
    </div>
@endsection
