@extends ('main')

@section('title', '| View Author')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>Author name: {{  $author->name }}</h1>
        <h3>Gender: {{ $author->gender }}</h3>
        <h3>Country: {{ $author->country->name }}</h3>
        <h3>Age:
            @if ($author->age == 0)
            No Date Given
            @else
            {{ $author->age }}
            @endif
        </h3>
        <h3>Birth date: 
            @if ($author->birth_date == 0)
            No Age Given
            @else
            {{ $author->birth_date }}
            @endif
        </h3>
        <h3>Death date:
            @if ($author->birth_date == 0)
            No Date Given
            @else
            {{ $author->death_date }}
            @endif
        </h3>
        <h3>Last edited by: {{$author->user->name or "No User" }}</h3>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($author->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($author->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.authors.edit', 'Edit', array($author->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['music.authors.destroy', $author->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('music.authors.index', 'All Authors', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection