<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostFormRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        
        return view('backend.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    public function store(PostFormRequest $request)
    {
        $user_id = Auth::user()->id;
        $post= new Post(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => Str::slug($request->get('title'), '-'),
            'user_id' => $user_id
        ));

        $post->save();
        $post->category()->sync($request->get('categories'));

        return redirect('/admin/posts/create')->with('status', 'The post has been created!');
    }

    public function edit($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->category->pluck('id')->toArray();
        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    public function update($id, PostFormRequest $request)
    {
        $post = new Post(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'Slug' => Str::slug($request->get('title'), '-'),
            'id' => $id
        ));
        $post->save();
        $post->category()->sync($request->get('categories'));
        return redirect(action('Admin\PostsController@edit', $post->id))
        ->with('status', 'The post has been updated!');
    }

    public function destroy()
    {

    }

}
