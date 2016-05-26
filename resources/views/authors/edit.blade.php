@extends('main')

@section('title', '| Edit Author')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section ('content')
    
<div class="row">
    {!! Form::model($author, ['route' => ['music.authors.update', $author->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
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

    </div>
    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('j M, Y H:i', strtotime($author->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{  date('j M, Y H:i', strtotime($author->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.authors.show', 'Cancel', array($author->id), array('class' => 'btn btn-danger btn-block')) !!}
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