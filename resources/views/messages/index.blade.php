@extends('main')

@section('title', '| All Your Messages')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1>All Your Messages</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('messages.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Send a message</a>
    </div>
    <div class="col-md-12">
    <hr>
    </div> <!-- end of row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th></th>
                </thead>
                
                <tbody>
                    
                    @foreach ($messages as $message)
                    
                    <tr>
                        <th>{{ $message->title }}</th>
                        <td>{{ substr($message->body, 0, 50) }}{{ strlen($message->body) > 50 ? "..." : ""  }}</td>
                        <td>{{ date('j M, Y H:i', strtotime($message->created_at)) }}</td>
                        <td>{{ $message->sender->name }}</td>
                        <td>{{ $message->recipient->name }}</td>
                        <td class="text-right"><a href="{{ route('messages.show',$message->id) }}" class="btn btn-default btn-sm">View</a></td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="text-center">
                {!! $messages->links(); !!}
            </div>
        </div>
    </div>
</div>

@endsection