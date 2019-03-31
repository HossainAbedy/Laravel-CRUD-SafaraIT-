<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Member;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageuser()
    {
        $users= User::all();
        return view('admin.show')->with('users',$users);
    }

    public function managemember()
    {
        $members= Member::all();
        return view('admin.addmember')->with('members',$members);
    }
    public function changerole(Request $request){
        $user=User::findOrFail($request->id);
        if($user->admin ===  'admin'):
            $user->update(['admin' => 'user']);
            // return view('admin.show')->with('users',$users);
            return redirect('/admin/show')->with('success','User role changed to User');
        else:
            $user->update(['admin' => 'admin']);
            // return view('admin.show')->with('users',$users);
            return redirect('/admin/show')->with('success','User role changed to Admin');
        endif;
    }

    public function removeuser(Request $request){
        $user=User::findOrFail($request->id);
        $user->delete();
        return redirect('/admin/show')->with('success','Member Deleted');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // if(auth()->user()->id!==$member->user_id){
        //     return redirect('/members')->with('error','Unauthorized Page');
        // }
        return view('admin.adminedit')->with('member',$member);
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
        return redirect('/admin')->with('success','Members list updated');
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
        
        // //cheack for valid user
        // if(auth()->user()->id!==$member->user_id){
        //     return redirect('/members')->with('error','Unauthorized Page');
        // }

        if($member->cover_image!='noimage.jpg'){
              Storage::delete('public/cover_images/'.$member->cover_image);
        }
  
        $member->delete();
        return redirect('/admin/addmember')->with('success','Member Deleted');
    }
}
