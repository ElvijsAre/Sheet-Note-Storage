@extends ('main')

@section('title', "| $post->title")

@section('content')

<div class="row">
    <div class='col-md-8 col-md-offset-2'>
        <div class="panel panel-default">
            <div class="panel-heading">{{ $post->title }}</div>
            <div class="panel-body">
                 <form class="form-horizontal">
                     <div class="form-group">
                        <div class="col-sm-10">
                            <p>{{ $post->body }}</p>
                            <p>Author: {{ $post->user->name }}</p>
                        </div>
                     </div>
                 </form>
            </div>
            <div class="panel-heading">Post Comments</div>
            <div class="panel-body">
            @foreach ($post->comments as $comment)
            <p>{{ $comment->body }}</p>
            <p>Author: {{ $comment->user->name }}</p>
            <hr>
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

<!--
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
    <div class="panel-heading">Registarion</div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label form-group']) }}
                <div class="col-sm-10">
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </form>
    </div>
</div>

--->