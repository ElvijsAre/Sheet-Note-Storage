@extends ('main')

@section('title', '| View Message')

@section('content')

<div class="row">
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
                    {!! Html::linkRoute('messages.create', 'New Message', array() , array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Html::linkRoute('messages.edit', 'Delete', array($message->id), array('class' => 'btn btn-danger btn-block')) !!}          
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('messages.index', 'All Messages', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection