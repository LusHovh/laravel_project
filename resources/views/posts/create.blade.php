<head>
  <style>
   .has-success, .form-control {border-color: #ccc !important;}
   textarea
    {
    resize: none;
    }
  </style>
</head>

@extends('layouts.app')
@section('content')
    <div class="container" style='margin-top: 30px'>
        <hr/>
        <h1>Create New POST here.!</h1>
        <hr/>
        @if(isset($post))
            {{ Form::model($post, ['url' => '/posts/'.$post->id, 'method' => 'PUT', 'files' => true]) }}
        @else 
            {!! Form::open(['url' => 'posts', 'method' => 'POST', 'files' => true]) !!}
        @endif
            <div class=" form-group">

                <label class="form-control-label" >Title Your POST</label>
                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'inputSuccess1']) !!}
                <div class="form-control-feedback"></div>
                <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">A few words ABOUT it...!</label>
                {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'exampleTextarea',
                 'rows' => '3']) !!}
            </div>
            <div class="form-group">
                <label for="upload" control-label>UPLOAD IMAGE</label>
                <div>
                    {!! Form::file('image', null, ['class' => 'form-control', 'id' => 'fileToUpload']) !!}
                @if(isset($post))
                    <img src="/images/{{$post->image}}" width='70'>
                @endif
                </div>
            </div>
            <div class="form-group">
                <div >
                    {!! Form::submit('Add Post', ['class' => 'btn btn-default']) !!}
                </div>
            </div>
            {!! Form::close() !!}
    </div> 
@endsection