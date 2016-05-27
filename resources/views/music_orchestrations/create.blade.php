@extends('main')

@section('title',' | Add New Notes')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Add new Notes</h1>
        <hr>
        
        {!! Form::open(array('route' => 'music.orchestrations.store', 'method'=>'POST', 'files'=>true, 'data-parsley-validate' => '')) !!}
        
            {{ Form::label('musical', 'Musical:') }}
            {{ Form::select('musical', App\Sheet_music::lists('title', 'id'), null, ['class' => 'form-control']) }}
        
            {{ Form::label('file_name', 'Songs title:') }}
            {{ Form::text('file_name', null, array('class' => 'form-control')) }}
            
            {{ Form::label('file', 'Sheet Notes:') }}
            {{ Form::file('file[]', ['class' => 'form-control', 'multiple']) }}
            
            {{ Form::submit('Add Notes', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection