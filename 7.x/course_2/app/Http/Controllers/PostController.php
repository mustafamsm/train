<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts=Post::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();
        
        return view('posts.index')->with('posts',$posts);
    }
    public function postsTrashed(){
        $posts=Post::onlyTrashed()->where('user_id',Auth::id())->paginate(3);
        return view('posts.trashed')->with('posts',$posts);
    }
 
    public function create()
    {
        $tags=Tag::all();
        if ($tags->count()==0) {
         return  redirect()->route('tags.create');
        }
        return view('posts.create')->with('tags',$tags);
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>  'required',
            'content' =>  'required',
            'tags'=>'required',
            'photo' =>  'required|image',
        ]);
        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newPhoto);

        $post=Post::create([
            'user_id' =>  Auth::id(),
            'title' =>  $request->title,
            'content' =>   $request->content,
            'photo' =>  'uploads/posts/'.$newPhoto,
            'slug' =>  Str::slug($request->title),
        ]);
        $post->tag()->attach($request->tags);//لاضافة كل العناصر في الشيك بوكس
        return redirect()->back();
    }

   
    public function show($slug)
    {
        $post=Post::select()->where("slug",$slug)->where('user_id',Auth::id())->first();
        if($post===null){
            return redirect()->back();
        }
        return view('posts.show')->with('post',$post);
    }

    
    public function edit($id)
    {
        $post=Post::find($id);
        $tags=Tag::all();
        return view('posts.edit')->with('post',$post)->with('tags',$tags);
    }

   
    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        $this->validate($request,[
            'title' =>  'required',
            'content' =>  'required',
           
        ]);
        if($request->has('photo')){
            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/posts',$newPhoto);
            $post->photo='uploads/posts/'.$newPhoto;
        }
            $post->title=$request->title;
            $post->content=$request->content;
            $post->save();
            $post->tag()->sync($request->tags);
            return redirect()->back();
    }

    
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    public function hdelete($id)
    {
        $post = Post::withTrashed()->where('id' ,  $id )->first() ;
        $post->forceDelete();
        return redirect()->back() ;
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id' ,  $id )->first() ;
        $post->restore();
        return redirect()->back() ;
    }
}
