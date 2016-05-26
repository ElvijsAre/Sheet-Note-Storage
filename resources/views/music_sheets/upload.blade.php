@extends ('main')

@section('title', '| Upload Notes')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $sheet->title }}</h1>

        <p class="lead">TEST</p>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Category(s):</label>
                @foreach ($sheet->music_categories as $category)
                             <p>{{ $category->name }}</p>
                @endforeach
            </dl>
            <dl class="d2-horizontal">
                <label>Category(s):</label>
                @foreach ($sheet->music_author as $author)
                             <p>{{ $author->name }}</p>
                @endforeach
            </dl>
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($sheet->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($sheet->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('music.sheets.edit', 'Edit', array($sheet->id), array('class' => 'btn btn-primary btn-block')) !!}
                    {!! Html::linkRoute('music_sheets.upload', 'Add Notes', array($sheet->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['music.sheets.destroy', $sheet->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('music.sheets.index', 'All Musicals', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection