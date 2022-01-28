<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        $title = "Users";
        $properties = ['ID','Name','Status','Created At','Actions'];
        return view('backend.users.index',compact('users','properties','title'));
    } 

    public function edit($id)
    {
        $user = DB::table('users')->where('id',$id)->first();
        return view('backend.users.edit',compact('user'));
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'page');
        DB::table('users')->where('id', $id)->update($data);
        return $this->redirectAccordingToRequest($request);
    }
    public function destroy($id)
    {        
        DB::table('users')->where('id',$id)->delete();
        return redirect()->back()->with('success','User has been deleted successfully');
    }

    private function redirectAccordingToRequest($request)
    {
        if ($request->page == 'back') {
            return redirect()->back()->with('success', 'User has been updated successfully');
        } else {
            return redirect()->route('users.index')->with('success', 'User has been updated successfully');
        }
    }



}