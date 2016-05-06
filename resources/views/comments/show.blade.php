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
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('comments.edit', 'Edit', array($comment->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('comments.index', 'All Comments', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
        </div>

    </div>
</div>
    
    
    
@endsection
