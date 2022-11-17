<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts=Post::all();
        return view('posts.index',compact('posts'));
    }

  
    public function create()
    {
        
        return view('posts.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
           'description'=>'required'
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

 
    public function show($id)
    {
        $post=Post::find($id);
        return view('posts.show',compact('post'));
    }

    public function edit($id)
    {
        $post=Post::find($id);
        if ($post === null) {
            return redirect()->back() ;
        }
        return view('posts.edit',compact('post'));
    }

 
    public function update(Request $request, $id)
    {
        $post = Post::find( $id ) ;
        $this->validate($request,[
            'title' =>  'required',
            'description' =>  'required'
        ]);
        $post->title=$request->title;
        $post->description=$request->description;
        $post->save();
        return redirect()->back() ;
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        if($post==null){
            return redirect()->back() ;
        }
        $post->delete($id);
        return redirect()->back() ;
    }
}
