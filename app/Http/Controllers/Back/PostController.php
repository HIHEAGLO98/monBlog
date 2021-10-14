<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\DataTables\PostsDataTable;
use App\Http\Requests\Back\PostRequest;
use App\Repositories\PostRepository;
use App\Models\Category ;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PostsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $post = null;
        if($id) {
            $post = Post::findOrFail($id);
            if($post->user_id === auth()->id()) {
                $post->title .= ' (2)';
                $post->slug .='-2';
                $post->active = false;
            } else {
                $post = null;
            }
        }

        $categories = Category::all()->pluck('title', 'id');
        return view('back.posts.form', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostRepository $repository)
    {
        $repository->store($request);
        return back()->with('ok', __('The post has been successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
