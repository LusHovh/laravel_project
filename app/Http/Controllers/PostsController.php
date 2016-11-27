<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PostService;
use File;
use Auth;
use Validator;
use App\Http\Requests\StoreBlogPostRequest;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(PostService $postService)
    {
        $posts = $postService->getAllPosts();
        return view('posts.index',['posts' => $posts]);
    }

    public function myPosts($id, PostService $postService)
    {
        $posts = $postService->getMyPosts();
        return view('posts.index',['posts' => $posts]);
    }

    public function showPost($id, PostService $postService)
    {
       $posts = $postService->getPostById($id);
       return view('posts.showMyPost',['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($id)
    {
       
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    public function edit($id, PostService $postService)
    {
        $post = $postService->getPostById($id);
        return view('posts.create', ['post' => $post]);
    }

    public function update(Request $request, $id, PostService $postService)
    {
        if(null != $postService->updatePost($request->all(), $id)) {
            return redirect('posts')->withSuccess('Post has been successfully updated');
        }
        return redirect()->back()->withWarning('Something went wrong. Please try later');
    }

    public function store(StoreBlogPostRequest $request, PostService $postService)
    {
        $postService->createPost($request->all());
        
        return redirect('posts');
    }

    public function destroy($id, PostService $postService)
    {
        $post = $postService->getPostById($id);
        $post->delete();
        $file=$post->image;
        File::delete('images/'.$file);

        return redirect('posts');
    }
}
