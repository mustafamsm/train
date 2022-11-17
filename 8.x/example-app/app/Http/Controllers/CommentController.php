<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   
   
  
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            
           'description'=>'required'
        ]);
        $input=$request->all();
        $input['user_id']=Auth::id();
        Comment::create($input);
        return redirect()->back();
    }

 
    
}
