<head>
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
</head>
@extends('layouts.app')
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
                 			<a href="{{url('/posts/'.$post->id.'/edit')}}"><button class = "btn btn-sm btn-default">EDIT</button></a>
                 			<form action='{{url('/posts/'.$post->id)}}' method='post' style='display: inline-block'>
                                <input type='hidden' name='_method' value='DELETE'>
                                {{csrf_field()}}
                                <button  class = "btn btn-sm btn-default"  type='submit'>Delete Post</button> 
                            </form>                      
                        @endif                        
        			</div>
      			</div>
            @endforeach
		</div>
	</div>
@endsection