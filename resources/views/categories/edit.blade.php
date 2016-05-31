@extends('main')

@section('title', '| Edit Category')

@section ('content')
    
<div class="row">
    {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        {{ Form::label('name', 'Category Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('categories.show', 'Cancel', array($category->id), array('class' => 'btn btn-danger btn-block')) !!}
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