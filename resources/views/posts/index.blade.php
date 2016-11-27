@extends('layouts.app')

@section('style')
	<style>
		.images
		{
			width : 500px;
			height : auto;
			margin-bottom: 10px;
		}
		.img_cont
		{
			border : 1px solid #ddd;
			border-radius : 5px;
			padding : 10px;
			background-color : white;
			margin-bottom: 30px;
			height: 315px;
		}
		.title, .content
		{
			color : #777;
		}
		.cols:hover
		{
			padding-right: 3px;
			padding-left: 3px;

		}
		.img_cont:hover
		{
			background-color: #f1f1f1;
		}
	</style>
@endsection
@section('content')
@include('alerts.messages')	
	<div class="container">
		<div class="row row_cont">
            @foreach($posts as $post)
      			<div class="col-md-3 col-offset-1 cols">
       				 <div class='img_cont'>
             			 <a class="title" href='posts/{{$post->id}}/showPost'>{{$post->title}}</a>
        		         <p class="content">{{$post->content}}</p>
             			 <img class="img-responsive img-thumbnail images" src='../images/{{$post->image}}' style="width:500px; height: 200px">
                         @if ($post->user_id == Auth::user()->id)

                             <form action='{{url('/posts/'.$post->id.'/edit')}}' method='get' style='display: inline-block'>
                                 <button class = "btn btn-sm btn-default" type='submit'>EDIT</button>
								 {{ csrf_field() }}
                             </form>

                             <form action='{{url('/posts/'.$post->id.'/delete')}}' method='post' style='display: inline-block'>
                                 <button class = "btn btn-sm btn-default" type='submit'>DELETE</button>
								 {{ csrf_field() }}
                             </form>
                        @endif
        			</div>
      			</div>
            @endforeach
		</div>
	</div>
@endsection