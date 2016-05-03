@extends('main')

@section('title', '| All Comments')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Comments</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('comments.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Comments</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Post Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Author</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach($comments as $comment)
                    
                    <tr>
                        <th>{{ $comment->id }}</th>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ substr($comment->body, 0, 50) }}{{ strlen($comment->body) > 50 ? "..." : ""  }}</td>
                        <td>{{ date('j M, Y H:i', strtotime($comment->created_at)) }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td><a href="{{ route('comments.show',$comment->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $comments->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection