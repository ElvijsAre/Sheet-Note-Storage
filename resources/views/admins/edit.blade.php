@extends('main')

@section('title', '| Edit User')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section ('content')
    
<div class="row">
    {!! Form::model($user, ['route' => ['admin.update', $user->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
        
        {{ Form::label('age', 'Age:') }}
        {{ Form::number('age', null, ['class' => 'form-control']) }}
        
        {{ Form::label('birth_date', 'Birth date:') }}
        {{ Form::date('birth_date', null, ['class' => 'form-control']) }}
        
        {{ Form::label('gender', 'Gender:') }}
        {{ Form::radio('gender', 'Other' ) }} Other
        {{ Form::radio('gender', 'Male') }} Male
        {{ Form::radio('gender', 'Female') }} Female
        <br>
        {{ Form::label('country', 'Country:') }}
        {{ Form::select('country', App\Country::lists('name', 'id'), null, ['class'=> 'form-control']) }} 
        
        {{ Form::label('is_blocked', 'Blocked:' ) }}
        {{ Form::select('is_blocked', ['0' => 'NO', '1' => 'YES' ], null, ['class'=> 'form-control']) }}
        
        {{ Form::label('is_admin', 'Admin:' ) }}
        {{ Form::select('is_admin', ['0' => 'NO', '1' => 'YES' ], null, ['class'=> 'form-control']) }}
    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('j M, Y H:i', strtotime($user->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{  date('j M, Y H:i', strtotime($user->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('admin.show', 'Cancel', array($user->id), array('class' => 'btn btn-danger btn-block')) !!}
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