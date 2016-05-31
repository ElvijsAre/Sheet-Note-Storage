@extends('main')

@section('title',' | Create New Category')

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Create Category</h1>
        <hr>
        
        {!! Form::open(array('route' => 'categories.store')) !!} 
                   
            {{ Form::label('name', 'Category Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            
            {{ Form::submit('Create Category', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection