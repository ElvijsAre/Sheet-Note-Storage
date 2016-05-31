@extends('main')

@section('title',' | Create New Musical')

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Create New Musical</h1>
        <hr>
        
        {!! Form::open(array('route' => 'music.sheets.store')) !!}
        
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
                   
            {{ Form::label('categories', 'Categories:') }}
            {{ Form::select('categories[]', App\Music_categories::lists('name', 'id'), null, ['class' => 'form-control', 'multiple']) }}
            
            {{ Form::label('authors', 'Authors:') }}
            {{ Form::select('authors[]', App\Music_author::lists('name', 'id'), null, ['class' => 'form-control', 'multiple']) }}
            
            {{ Form::submit('Create Musical', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>
    
@endsection