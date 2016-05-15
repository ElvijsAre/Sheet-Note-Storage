@extends ('main')

@section('title', '| View Music Categories')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $category->name }}</h1>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($category->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($category->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['music.categories.destroy', $category->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('music.categories.index', 'All Categories', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection