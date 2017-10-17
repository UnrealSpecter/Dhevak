@extends('backend.layout')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            @foreach($images as $image)
                <tr class='clickable-row' data-href="/admin/roles/{{$role->id}}">
                    <th>{{$role->image_url}}</th>
                </tr>
            @endforeach
        </table>
        <a href="/admin/roles/create" class="btn btn-info">Create</a>
    </div>

    <script>
        $(document).ready(function($){
            $(".clickable-row").click(function(){
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
