@extends('main')
@section ('title', '| Homepage')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p class="lead"> Work in Progress </p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
        </div>
    </div>
</div> <!-- end of header .row-->

<div class="row">
    <div class="col-md-8">
        
        @foreach($posts as $post)
        
        <div class="post">
            <h3>{{ $post->title }}</h3>
            <p>{{ substr($post->body, 0, 300) }}{{ strlen($post->body) > 300 ? "..." : "" }}</p>
            <a href="{{ url(('forum/'.$post->slug)) }}" class="btn btn-primary">Read More</a>
        </div>

        <hr>
        
        @endforeach

    </div>
    <div class="col-md-3 col-md-offset-1">
        <h2>Sidebar</h2>
    </div>           
</div>
@endsection