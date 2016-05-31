@extends('main')

@section('title', '| Edit Musical')


@section ('content')
    
<div class="row">
    {!! Form::model($sheet, ['route' => ['music.sheets.update', $sheet->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, array('class' => 'form-control')) }}
                   
        {{ Form::label('categories', 'Categories:') }}
        {{ Form::select('categories[]', App\Music_categories::lists('name', 'id'), null, ['class' => 'form-control', 'multiple']) }}
            
        {{ Form::label('authors', 'Authors:') }}
        {{ Form::select('authors[]', App\Music_author::lists('name', 'id'), null, ['class' => 'form-control', 'multiple']) }}

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
                    {!! Html::linkRoute('music.sheets.show', 'Cancel', array($sheet->id), array('class' => 'btn btn-danger btn-block')) !!}
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