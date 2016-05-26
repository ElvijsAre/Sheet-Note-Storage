@extends('main')

@section('title', '| All Authors')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Authors</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('music.authors.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Add a new author</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Age</th>
                    <th>Birth date</th>
                    <th>Death date</th>
                    <th>Gender</th>
                    <th>Last edited by</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($authors as $author)
                    
                    <tr>
                        <th>{{ $author->id }}</th>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->country->name }}</td>
                        <td>{{ $author->age }}</td>
                        <td>{{ date('j M, Y H:i', strtotime($author->birth_date)) }}</td>
                        <td>{{ date('j M, Y H:i', strtotime($author->death_date)) }}</td>
                        <td>{{ $author->gender }}</td>
                        <td>{{ $author->user->name or "No User" }}</td>
                        <td><a href="{{ route('music.authors.show',$author->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('music.authors.edit', $author->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $authors->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection