@extends('main')

@section('title', '| Edit Post')

@section ('content')
    
<div class="row">
    {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        <h1>{{ $comment->post->title }}</h1>
                   
        {{ Form::label('body', 'Comment Body:') }}
        {{ Form::textarea('body', null, array('class' => 'form-control')) }}
            

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('j M, Y H:i', strtotime($comment->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{  date('j M, Y H:i', strtotime($comment->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('comments.show', 'Cancel', array($comment->id), array('class' => 'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Save Changes', ["class" => 'btn btn-success btn-block']) }}
                </div>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>

@endsection