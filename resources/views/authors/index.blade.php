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
                        <th>{{ $author->name }}</th>
                        <td>{{ $author->country->name }}</td>
                        <td>
                            @if ($author->age == 0)
                            No Age Given
                            @else
                            {{ $author->age }}
                            @endif
                        </td>
                        <td>
                            @if ($author->birth_date == 0)
                            No Date Given
                            @else
                            {{ date('j M, Y', strtotime($author->birth_date)) }}
                            @endif
                        </td>
                        <td>
                            @if ($author->death_date == 0)
                            No Date Given
                            @else
                            {{ date('j M, Y', strtotime($author->death_date)) }}
                            @endif
                        </td>
                        <td>{{ $author->gender }}</td>
                        <td>{{ $author->user->name or "No User" }}</td>
                        <td class="text-right"><a href="{{ route('music.authors.show',$author->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('music.authors.edit', $author->id) }}" class="btn btn-default btn-sm">Edit</a></td>
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