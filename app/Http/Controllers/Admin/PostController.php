<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationData(), $this->validationErrors());
        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateUniqueSlug($new_post->title);

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', compact('post'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationData(), $this->validationErrors());

        $data = $request->all();

        if($data['title'] != $post->title){
            $data['slug'] = Post::generateUniqueSlug($data['title']);
        }

        $post->update($data);
        
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato correttamente');
    }

    private function validationData(){
        return [
            'title' => 'required|min:2|max:255',
            'content' => 'required'
        ];
    }

    private function validationErrors(){
        return [
            'title.required' => 'Il titolo è un campo obbligatorio',
            'title.min' => 'Il titolo deve contenere almeno :min carateri',
            'title.max' => 'Il titolo deve contenere massimo :max carateri',

            'content.required' => 'Il contenuto è un campo obbligatorio'
        ];
    }
}
