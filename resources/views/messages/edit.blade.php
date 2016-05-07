@extends('main')

@section('title', '| Edit Post')

@section('stylesheets')
    <!-- Parsly CSS validation -->
    {!! Html::style('css/parsley.css') !!}

@endsection

@section ('content')
    
<div class="row">
    {!! Form::model($message, ['route' => ['messages.update', $message->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
    <div class="col-md-8">

        <h1>{{ $message->title }}</h1>

        <p class="lead">{{ $message->body }}</p>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Recipient:</label>
                <p>{{ $message->recipient->name }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Sender:</label>
                <p>{{ $message->sender->name }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($message->created_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('messages.show', 'Cancel', array($message->id), array('class' => 'btn btn-success btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('DELETE', ["class" => 'btn btn-danger btn-block']) }}
                </div>
            </div>
        </div>

    </div>
    {!! Form::close() !!}


@endsection

@section('scripts')
     <!-- Parsly Js validation -->
    {!! Html::script('js/parsley.min.js') !!}
    
@endsection