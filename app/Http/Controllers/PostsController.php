<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PostService;
use File;
use Auth;
use Validator;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show', $id);
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostService $postService)
    {
        $post = $postService->getPostById($id);
        return view('posts.create', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PostService $postService)
    {
        if(null != $postService->updatePost($request->all(), $id)) {
            return redirect('posts')->withSuccess('Post has been successfully updated');
        }
        return redirect()->back()->withWarning('Something went wrong. Please try later');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PostService $postService)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'image'=> 'mimes:jpeg,bmp,gif,png',
        ]);
        return redirect('posts')->withSuccess('Post has been successfully created');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostService $postService)
    {
        $post = $postService->getPostById($id);
        $post->delete();
        $file=$post->image;
        File::delete('images/'.$file);
        return redirect('/posts');
    }
}
