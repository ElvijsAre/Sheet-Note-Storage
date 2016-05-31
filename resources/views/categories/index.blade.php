@extends('main')

@section('title', '| All Categories')

@section('content')

<div class="row">
    <div class="col-md-9">
        <h1>All Categories</h1>
    </div>
    <div class="col-md-3">
        <a href="{{ route('categories.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Categories</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($categories as $category)
                    
                    <tr>
                        <th>{{ $category->name }}</th>
                        <td class="text-right"><a href="{{ route('categories.show',$category->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default btn-sm">Edit</a></td>
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