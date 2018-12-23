<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Image;
use App\History;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles');
    }
   
    public function index()
    {
        $posts=Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        $post= new Post;
        $post->title=$request->title;
        $post->description = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
             $filename = time().rand(111,999). '.' . $file->getClientOriginalExtension();
             $path = public_path('posts-images/'.$filename);
             Image::make($file)->resize(750, 500)->encode('jpg', 75)->save($path);
             $post->image = $filename;
        }
        $post->save();
        $this->CreateRecord(Auth::User()->name,"Created ".$post->title);
        return back();
    }
    public function edit($slug)
    {
        $post=Post::where('slug','=',$slug)->first();
        return view('posts.edit')->with('post',$post);
    }

    public function view($slug)
    {
        $post=Post::where('slug','=',$slug)->first();
        $this->CreateRecord(Auth::User()->name,"Viewed ".$post->title);
        return view('posts.view')->with('post',$post);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $post= Post::findOrFail($request->id);
        $oldtitle = $post->title;
        $post->title=$request->title;
        $post->description = $request->description;
        if($request->hasFile('image')){
            unlink('posts-images'.'/'.$post->image);
            $file = $request->file('image');
             $filename = time().rand(111,999). '.' . $file->getClientOriginalExtension();
             $path = public_path('posts-images/'.$filename);
             Image::make($file)->resize(750, 500)->encode('jpg', 75)->save($path);
             $post->image = $filename;
        }
        $post->save();
        $this->CreateRecord(Auth::User()->name,"Updated ".$oldtitle." to ".$post->title);
        return redirect('posts'.'/'.$post->slug);
    }

    public function delete(Request $request)
    {
        $post= Post::where('id','=',$request->id)->first();
        unlink('posts-images'.'/'.$post->image);
        $this->CreateRecord(Auth::User()->name,"Deleted ".$post->title);
        $post->delete();
    }

    public function history()
    {
        $histories = History::orderBy('id','desc')->get();
        return view('posts.history')->with('histories',$histories);
    }

    public function CreateRecord($user_name, $activity)
    {
        $history= new History;
        $history->activity=$activity;
        $history->user_name=$user_name;
        $history->save();
    }
}
