@extends('backend.layout')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            @foreach($projects as $project)
                <tr class='clickable-row' data-href="/admin/projects/{{$project->id}}">
                    <th>{{$project->title}}</th>
                </tr>
            @endforeach
        </table>
        <a href="/admin/projects/create" class="btn btn-info">Create</a>
    </div>

    <script>
        $(document).ready(function($){
            $(".clickable-row").click(function(){
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
