<?php

namespace App\Services;
use App\Models\Post;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PostService
{
	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function getAllPosts() 
	{
		return $this->post->get();
	}

	public function getMyPosts() 
	{
        return $posts = $this->post->where("user_id", Auth::user()->id)->get();
	}

	public function getPostById($id) 
	{
		return $this->post->find($id);
	}

	public function updatePost($params, $id) 
	{
		$post = $this->getPostById($id);
		if(isset($params['image'])) {
			$image = $params['image'];
			$file_name = $this->getImageName($params['image']);
			$image->move(public_path().'/images/', $file_name);
		} else {
			$file_name = $post->image;
		}
		$inputs = $this->getUpdateParams($params, $file_name);
		return $post->update($inputs);
	}

	public function getImageName($file)
	{
		$file_name = str_random(32).'.'.$file->getClientOriginalExtension();
		return $file_name;
	}
	
    public function createPost($params) 
    {		
		if(isset($params['image'])) {
			$image = $params['image'];
			$file_name = $this->getImageName($params['image']);
			$image->move(public_path().'/images/', $file_name);
		} 
		$inputs = $this->getUpdateParams($params, $file_name);           
        
		return $this->post->create($inputs);
	}

	private function getUpdateParams($params, $file_name) 
	{
		$inputs = [];
		$inputs['title'] = $params['title'];
		$inputs['content'] = $params['content'];
		$inputs['image'] = $file_name;
		$inputs['user_id']  = Auth::user()->id;
		return $inputs;
	}
}
