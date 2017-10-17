@extends('backend.layout')

@section('js')
    <script src="/js/global/countdown.js"></script>
    <script src="/js/global/moment.js"></script>
    <script src="/js/global/moment-timezone-with-data.js"></script>
@endsection

@section('content')
    <h1>Role</h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Name:</th>
                <th>{{$role->name}}</th>
            </tr>
        </table>
        <a href="/admin/roles/{{$role->id}}/edit" class="btn btn-info">Edit</a>
        {{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) }}
            {{ Form::hidden('id', $role->id) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    </div>
@endsection
