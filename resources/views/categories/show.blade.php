@extends ('main')

@section('title', '| View Categories')

@section('content')

<div class="row">
    <div class="col-md-8">

        <h1>{{ $category->name }}</h1>

    </div>

    <div class="col-md-4">
        
        <div class="well">
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}           
                    {!! Form::submit('Delete', ["class" => 'btn btn-danger btn-block']) !!}                    
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('categories.index', 'All Categories', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection