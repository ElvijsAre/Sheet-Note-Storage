@extends ('main')

@section('title', '| View Musical')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $sheet->title }}</h1>
        
        @foreach ($sheet->music_orchestration as $orchestration)
            {!! Html::link("download/$orchestration->file_name", "$orchestration->file_name") !!}
        @endforeach
        
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