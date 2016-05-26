@extends('main')

@section('title',' | Send a New Message')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Send a New Message</h1>
        <hr>
        
        {!! Form::open(array('route' => 'messages.store', 'data-parsley-validate' => '')) !!}
        
            {{ Form::label('recipient', 'Recipient:') }}
            {{ Form::select('recipient', App\User::lists('name', 'id'), null, ['class'=> 'form-control']) }}
        
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                   
            {{ Form::label('body', 'Message Body:') }}
            {{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '')) }}
            
            {{ Form::submit('Send Message', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection