@extends('main')

@section('title', '| All Notes')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Musicals</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('music.orchestrations.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Add a Musical</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>title</th>
                    <th>Added by</th>
                    <th>Author(s)</th>
                    <th>Category(s)</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($sheets as $sheet)
                    
                    <tr>
                        <th>{{ $sheet->id }}</th>
                        <td>{{ $sheet->title }}</td>
                        <td>{{ $sheet->user->name }}</td>
                        <td>
                            @foreach ($sheet->music_author as $author)
                            {{ $author->name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($sheet->music_categories as $category)
                            {{ $category->name }}
                            @endforeach
                        </td>
                        <td>TBA</td>
                        <td><a href="{{ route('music.sheets.show',$sheet->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('music.sheets.edit', $sheet->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $sheets->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection