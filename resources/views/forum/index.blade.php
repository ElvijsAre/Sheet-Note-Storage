@extends('main')

@section('title', '| Forum')

@section('content')

<div class="row">
    <div class='col-md-8 col-md-offset-2'>
        <h1>Forum</h1>
    </div>
</div>

@foreach ($posts as $post)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>{{ $post->title }}</h2>
        <h4>{{ $post->category->name }}</h4>
        <h5>Published: {{ date('j M, Y H:i', strtotime($post->created_at)) }}</h5>
        
        <p>{{ substr($post->body, 0, 250) }}{{ strlen($post->body) > 250 ? "..." : "" }}</p>
        
        <a href="{{ route('forum.single', $post->slug) }}" class="btn btn-primary">Read More</a>
    </div>
</div>
<hr>
@endforeach

<div class='row'>
    <div clas='col-md-12'>
        <div class='text-center'>
            {!! $posts->links() !!}
        </div>
    </div>
</div>

@endsection