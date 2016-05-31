@extends ('main')

@section('title', '| View User')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>Username: {{ $user->name }}</h1>
        <h3>Email:{{ $user->email }}</h3>
        <h3>Gender: {{ $user->gender }}</h3>
        <h3>Country: {{ $user->country->name }}</h3>
        <h3>Age: {{ $user->age }}</h3>
        <h3>Birth date: {{ $user->birth_date }}</h3>
        <h3>Admin: {{ $user->is_admin == 1 ? "YES" : "NO" }}</h3>
        <h3>Blocked: {{ $user->is_blocked == 1 ? "YES" : "NO" }}</h3>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('j M, Y H:i', strtotime($user->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{  date('j M, Y H:i', strtotime($user->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    {!! Html::linkRoute('admin.edit', 'Edit', array($user->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('admin.index', 'All Users', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection