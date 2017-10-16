@extends('backend.layout')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            @foreach($socialMedia as $medium)
                <tr class='clickable-row' data-href="/admin/social-media/{{$medium->id}}">
                    <th>{{$medium->name}}</th>
                </tr>
            @endforeach
        </table>
        <a href="/admin/social-media/create" class="btn btn-info">Create</a>
    </div>

    <script>
        $(document).ready(function($){
            $(".clickable-row").click(function(){
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
