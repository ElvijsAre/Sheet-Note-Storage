@extends('main')

@section('title',' | Create New Music Category')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <h1>Create Music Category</h1>
        <hr>
        
        {!! Form::open(array('route' => 'music.categories.store', 'data-parsley-validate' => '')) !!} 
                   
            {{ Form::label('name', 'Category Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            
            {{ Form::submit('Create Category', array('class' => 'btn btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection