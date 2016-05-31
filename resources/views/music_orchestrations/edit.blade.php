@extends('main')

@section('title', '| Edit Notes')


@section ('content')
    
<div class="row">
    {!! Form::model($musical, ['route' => ['music.orchestrations.update', $musical->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        {{ Form::label('musical', 'Musical:') }}
        {{ Form::select('musical', App\Sheet_music::lists('title', 'id'), null, ['class' => 'form-control']) }}
        
        {{ Form::label('file_name', 'Songs title:') }}
        {{ Form::text('file_name', null, array('class' => 'form-control')) }}
  

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('j M, Y H:i', strtotime($musical->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{  date('j M, Y H:i', strtotime($musical->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.orchestrations.show', 'Cancel', array($musical->id), array('class' => 'btn btn-danger btn-block')) !!}
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