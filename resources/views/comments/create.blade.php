@extends('main')

@section('title',' | Create New Comment')

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Create New Comment</h1>
        <hr>
        
        {!! Form::open(array('route' => 'comments.store')) !!}
        
            {{ Form::label('post', 'Post:') }}
            {{ Form::select('post', App\Post::lists('title', 'id'), null, ['class'=> 'form-control']) }}
                   
            {{ Form::label('body', 'Comment Body:') }}
            {{ Form::textarea('body', null, array('class' => 'form-control')) }}
            
            {{ Form::submit('Create Comment', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection