@extends('main')

@section('title', '| Edit Category')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section ('content')
    
<div class="row">
    {!! Form::model($category, ['route' => ['music.categories.update', $category->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        {{ Form::label('name', 'Category Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('j M, Y H:i', strtotime($category->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{  date('j M, Y H:i', strtotime($category->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.categories.show', 'Cancel', array($category->id), array('class' => 'btn btn-danger btn-block')) !!}
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

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection