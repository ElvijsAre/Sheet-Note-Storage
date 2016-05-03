@extends ('main')

@section('title', '| View Comment')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $comment->post->title }}</h1>
        <h1>{{ $comment->post->body }}</h1>

        <p class="lead">{{ $comment->body }}</p>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($comment->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($comment->updated_at)) }}</p>
            </dl>
            <hr>
        </div>

    </div>
</div>
    
    
    
@endsection
