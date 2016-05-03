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
        <div class="panel-heading">{{ $category->name }}</div>
        @foreach ($category->posts as $post)
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-10">
                    <h2>{{ $post->title }}</h2>
                    <h5>Published: {{ date('j M, Y H:i', strtotime($post->created_at)) }}</h5>

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