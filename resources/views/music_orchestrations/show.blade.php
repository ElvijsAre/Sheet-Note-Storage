@extends ('main')

@section('title', '| View Notes')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $musical->sheet_music->title }}</h1>
        
            {!! Html::link("download/$musical->file_name", "$musical->file_name") !!}
        
    </div>

    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($musical->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($musical->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.orchestrations.edit', 'Edit', array($musical->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['music.orchestrations.destroy', $musical->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('music.orchestrations.index', 'All Notes', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection