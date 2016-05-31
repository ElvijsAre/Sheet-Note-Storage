@extends('main')

@section('title', '| Back-end')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>Administrators view</h1>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Username</th>
                    <th>Is Admin?</th>
                    <th>Blocked</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($users as $user)
                    
                    <tr>
                        <th>{{ $user->name }}</th>
                        <td>{{ $user->is_admin == 1 ? "YES" : "NO" }}</td>
                        <td>{{ $user->is_blocked == 1 ? "YES" : "NO" }}</td>
                        <td class="text-right"><a href="{{ route('admin.show',$user->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('admin.edit',$user->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $users->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection



