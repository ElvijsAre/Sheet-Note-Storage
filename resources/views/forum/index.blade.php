@extends('main')

@section('title', '| Forum')

@section('content')

<div class="row">
    <div class='col-md-8 col-md-offset-2'>
        <h1>Forum</h1>
    </div>
</div>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        @foreach ($categories as $category)
        <div class="panel-heading"><h2>{{ $category->name }}</h2></div>
        @foreach ($category->posts as $post)
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-10">
                    <h4>{{ $post->title }}</h4>

                    <p>{{ substr($post->body, 0, 250) }}{{ strlen($post->body) > 250 ? "..." : "" }}</p>

                    <a href="{{ route('forum.single', $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        @endforeach
        @endforeach
    </div>


@endsection