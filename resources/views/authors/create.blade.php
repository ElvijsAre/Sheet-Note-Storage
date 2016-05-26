@extends('main')

@section('title',' | Send a New Message')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Add a new author</h1>
        <hr>
        
        {!! Form::open(array('route' => 'music.authors.store', 'data-parsley-validate' => '')) !!}
        
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        
            {{ Form::label('country', 'Country:') }}
            {{ Form::select('country', App\Country::lists('name', 'id'), null, ['class'=> 'form-control']) }}  
        
            {{ Form::label('age', 'Age:') }}
            {{ Form::number('age', null, ['class' => 'form-control']) }}
        
            {{ Form::label('birth_date', 'Birth date:') }}
            {{ Form::date('birth_date', null, ['class' => 'form-control']) }}
            
            {{ Form::label('death_date', 'Death date:') }}
            {{ Form::date('death_date', null, ['class' => 'form-control']) }}
        
            {{ Form::label('gender', 'Gender:') }}
            {{ Form::radio('gender', 'Other', true) }} Other
            {{ Form::radio('gender', 'Male') }} Male
            {{ Form::radio('gender', 'Female') }} Female
            <br>
            
            {{ Form::submit('Add Author', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection