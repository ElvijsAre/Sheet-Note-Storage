@extends('main')

@section('title',' | Add New Notes')

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Add new Notes</h1>
        <hr>
        
        {!! Form::open(array('route' => 'music.orchestrations.store', 'method'=>'POST', 'files'=>true)) !!}
        
            {{ Form::label('musical', 'Musical:') }}
            {{ Form::select('musical', App\Sheet_music::lists('title', 'id'), null, ['class' => 'form-control']) }}
        
            {{ Form::label('file_name', 'Songs title:') }}
            {{ Form::text('file_name', null, array('class' => 'form-control')) }}
            
            {{ Form::label('file', 'Sheet Notes:') }}
            {{ Form::file('file', ['class' => 'form-control']) }}
            
            {{ Form::submit('Add Notes', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection