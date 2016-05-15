@extends('main')

@section('title', '| All Music Categories')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Posts</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('music.categories.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Categories</a>
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
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($categories as $category)
                    
                    <tr>
                        <th>{{ $category->id }}</th>
                        <th>{{ $category->name }}</th>
                        <td><a href="{{ route('music.categories.show',$category->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('music.categories.edit', $category->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $categories->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection