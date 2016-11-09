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
            width: 50%;
            height: 80%;
    	}
    	.title, .content 
        {
    	 	color : #777;
    	}
       
        .img_cont:hover 
        {
            background-color: #f1f1f1;
        }
        .cols_cont 
        {
            text-align: -webkit-center;
        }
	</style>
</head>

@extends('layouts.app')
@section('content')
@include('alerts.messages')	
		<div class="container">
			<div class="row cols_cont">               
	  			<div class=" col-md-12 cols">
	   				<div class='img_cont'>
	     			<a class="title" href='posts/{{$posts->id}}/showPost'>{{$posts->title}}</a>
			        <p class="content">{{$posts->content}}</p>
	     			<img class="img-responsive img-thumbnail images" src='../../images/{{$posts->image}}' style="width:700px; height: auto">
                    @if ($posts->user_id == Auth::user()->id) 
    	     			<a href="{{url('/posts/'.$posts->id.'/edit')}}"><button class = "btn btn-sm btn-default">EDIT</button></a>
    	     			<form action='{{url('/posts/'.$posts->id)}}' method='post' style='display: inline-block'>
                            <input type='hidden' name='_method' value='DELETE'>
                            {{csrf_field()}}
                            <button  class = "btn btn-sm btn-default"  type='submit'>Delete Post</button>
                        </form>                              
                     @endif                    
	    			</div>
	  			</div>              
			</div>
		</div>	
@endsection