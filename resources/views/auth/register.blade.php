@extends('main')

@section('title', '| Register')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Registarion</div>
                <div class="panel-body">
        
        {!! Form::open() !!}
        
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
        
        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class' => 'form-control']) }}
        
        {{ Form::label('password_confirmation', 'Confirm Password:') }}
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        
        {{ Form::label('age', 'Age:') }}
        {{ Form::number('age', null, ['class' => 'form-control']) }}
        
        {{ Form::label('birth_date', 'Birth date:') }}
        {{ Form::date('birth_date', null, ['class' => 'form-control']) }}
        
        {{ Form::label('gender', 'Gender:') }}
        {{ Form::radio('gender', 'Other', true) }} Other
        {{ Form::radio('gender', 'Male') }} Male
        {{ Form::radio('gender', 'Female') }} Female
        <br>
        {{ Form::label('country', 'Country:') }}
        {{ Form::select('country', App\Country::lists('name', 'id'), null, ['class'=> 'form-control']) }}  
        
        {{ Form::submit('Register', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}
        
        {!! Form::close() !!}
        
            </div>
        </div>
    </div>
</div>
@endsection