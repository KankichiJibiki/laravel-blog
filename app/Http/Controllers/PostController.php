<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const LOCAL_STORAGE_FOLDER = 'public/image/';

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $post_paginate = Post::paginate(4);
        // $post_paginate = null;

        return view('posts.index')->with('post_paginate', $post_paginate);
        echo json_encode($post_paginate);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveImage($image){
        $image_name = time() . "." . $image->extension();
        #1661219552.jpeg // after change name
        $image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    public function store(Request $request)
    {
        $uuid = ['uuid' => Str::uuid()];
        $merged_request = array_merge($request->all(), $uuid);

        if($request->image){
            $image_array = ['image'=>$this->saveImage($request->image)];
            $merged_request = array_merge($merged_request, $image_array);
        }

        $request->validate([
            'title' => ['required', 'max:50'],
            'body' => ['required'],
        ]);

        $this->post->create($merged_request)->save();

        return redirect()->route('index')
        ->with('success', 'Posted your article successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')
        ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required', 'max:50'],
            'body' => ['required'],
            'image' => ['max:50'],
        ]);


        $post->fill($request->all())->save();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
