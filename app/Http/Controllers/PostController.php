<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.posts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'title'      => 'required|unique:posts|min:8|max:255',
            'post_image' => 'required|image',
            'body'       => 'required|min:10'
        ]);
        
        if($request->has('post_image')){
            //$validatedData['post_image'] = $request->post_image->store('images');
            $validatedData['post_image'] = $request->post_image->storeAs('images',
                $request->file('post_image')->getClientOriginalName()
            );
        }

        auth()->user()->posts()->create($validatedData);
    
        $request->session()->flash('success', 'Post was created!');
        
        return redirect()->route('posts.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        return view('blog-post', compact('post'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        
        return view('admin.posts.edit', compact('post'));
    
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        
        $validatedData = $request->validate([
            'title'      => 'required|min:8|max:255',
            'post_image' => 'image',
            'body'       => 'required|min:10'
        ]);
    
        if($request->has('post_image')){
    
            //Storage::delete($post->post_image);
            
            $validatedData['post_image'] = $request->post_image->storeAs('images',
                $request->file('post_image')->getClientOriginalName()
            );
            
        }
    
        $post->update($validatedData);
        
        //auth()->user()->posts()->create($validatedData);
    
        $request->session()->flash('success', 'Post was updated!');
    
        return redirect()->route('posts.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request) {
        
        $post->delete();
        $request->session()->flash('message', 'Post was deleted!');
        return back();
        
    }
}
