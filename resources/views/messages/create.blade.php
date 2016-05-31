@extends('main')

@section('title',' | Send a New Message')

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Send a New Message</h1>
        <hr>
        
        {!! Form::open(array('route' => 'messages.store')) !!}
        
            {{ Form::label('recipient', 'Recipient:') }}
            {{ Form::select('recipient', App\User::lists('name', 'id'), null, ['class'=> 'form-control']) }}
        
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
                   
            {{ Form::label('body', 'Message Body:') }}
            {{ Form::textarea('body', null, array('class' => 'form-control')) }}
            
            {{ Form::submit('Send Message', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection