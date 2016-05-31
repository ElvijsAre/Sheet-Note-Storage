@extends('main')

@section('title', '| All Notes')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Notes</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('music.orchestrations.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Add Notes</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Title</th>
                    <th>File name</th>
                </thead>
                
                <tbody>
                    
                    @foreach ($musicals as $musical)
                    
                    <tr>
                        <th>{{ $musical->sheet_music->title }}</th>
                        <td>{{ $musical->file_name }}</td>
                        <td class="text-right"><a href="{{ route('music.orchestrations.show',$musical->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('music.orchestrations.edit', $musical->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $musicals->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection