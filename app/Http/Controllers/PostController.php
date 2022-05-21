<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    public function index(){
        // pass posts to the post index view

        //$posts = Post::get(); //Gets a Collection (Laravel's advanced version of array) of all posts
        $posts = Post::with(['user', 'likes'])->paginate(20); //eager loading
        
        return view('post.index', [
          'posts' => $posts
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Post::create([
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);

        // auth()->user()->posts()->create([] //intellisense does not register posts method, but still works
        //     // laravel will automatically generate user id
        //     'body' => $request->body,
        // ]); 
    
        auth()->user()->posts()->create($request->only('body')); //cleaner version of above
        
        return back();
    }

    public function destroy(Post $post){

        // dd($post);
        //$request->user()->posts()->where('post_id', $post->id)->delete();
        $post->delete();

        return back();
    }

}
