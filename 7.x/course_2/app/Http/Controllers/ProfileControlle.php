<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Hash;
class ProfileControlle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user=Auth::user();//بيجيب المستخدم الي مسجل دخول
       $id=Auth::id();
       //is not exists profilev
       if($user->profile==null){
        $profile=Profile::create([
            'province'=>'GAZA',
            'gender'=>'Male',
            'bio'=>'Hello world',
            'facebook'=>'https://facebook.com',
            'user_id'=>$id,
        ]);
       }
       return view('user.profile')->with('user',$user);
    }

 
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'province'=>'required',
            'gender'=>'required',
            'bio'=>'required',
            
        ]);
        $user=Auth::user();
        $user->name=$request->name;
        $user->profile->province=$request->province;
        $user->profile->gender=$request->gender;
        $user->profile->bio=$request->bio;
        $user->save();
        $user->profile->save();

        if($request->has('password')){
            $user->password=Hash::make($request->password); 
            $user->save();
        }
        return redirect()->back()->with('succes','profile updedet susscflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
