<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Member;

class MembersController extends Controller
{
   
   
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','about','services']]);
    }
   
   
   
   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members= Member::all();
        return view('members.index')->with('members',$members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'positon'=>'required',
            'body'=>'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);

        //file upload function

        if($request->hasFile('cover_image')){
            //file name with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just file name
            $fileName=pathinfo( $fileNameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else{
            $fileNameToStore='noimage.jpg';
        }

        $member=new Member;
        $member->name=$request->input('name');
        $member->positon=$request->input('positon');
        $member->body=$request->input('body');
        $member->user_id=auth()->user()->id;
        $member->cover_image=$fileNameToStore;
        $member->save();
        return redirect('/members')->with('success','Member added to the list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member=Member::find($id);
        return view('members.show')->with('member',$member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member=Member::find($id);
        //cheack for valid user
        if(auth()->user()->id!==$member->user_id){
            return redirect('/members')->with('error','Unauthorized Page');
        }
        return view('members.edit')->with('member',$member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'positon'=>'required',
            'body'=>'required'
        ]);

        if($request->hasFile('cover_image')){
            //file name with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just file name
            $fileName=pathinfo( $fileNameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        

        $member=Member::find($id);
        $member->name=$request->input('name');
        $member->positon=$request->input('positon');
        $member->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $member->cover_image=$fileNameToStore;
        }
        $member->save();
        return redirect('/members')->with('success','Members list updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member=Member::find($id);
        
        //cheack for valid user
        if(auth()->user()->id!==$member->user_id){
            return redirect('/members')->with('error','Unauthorized Page');
        }

        if($member->cover_image!='noimage.jpg'){
              Storage::delete('public/cover_images/'.$member->cover_image);
        }
  
        $member->delete();
        return redirect('/members')->with('success','Member Deleted');
    }
}
