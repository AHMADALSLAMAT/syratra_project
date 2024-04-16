<?php

namespace App\Http\Controllers\Back_End;

use App\Models\Adminsuper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function users_index()
    {
        $users = Adminsuper::get();

        return view('Back_End.pages.users.users_index', compact('users'));
    }
    public function users_add()
    {
        return view('Back_End.pages.users.users_add');
    }
    public function users_add_post(Request $request)
    {
        $data = $request->all();

        //save single image
        $validation = Validator::make(
            $data,
            [
                'username' => 'required',
                'user_email' => 'required',
                'password' => 'required',
                'role' => 'required',
                'status' => 'required',

            ]
        );

        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }

        $password = Hash::make($data['password']);

        $users = new Adminsuper();
        $users->name = $data['username'];
        $users->email = $data['user_email'];
        $users->password =  $password;
        $users->role = $data['role'];
        $users->active = $data['status'];
        if ($users->save()) {
            session()->flash('success', 'Your User has been added successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Sorry your User data has error !!!!!');
            return back();
        }
    }
    public function users_edit($id)
    {
        $user = Adminsuper::where('id', $id)->first();
        if ($user) {
            return view('Back_End.pages.users.users_edit', compact('user'));
        } else {
            session()->flash('error', 'Your User is not found');
            return back();
        }
    }
    public function users_update_users(Request $request, $id)
    {
        //dd($request->all());
        $data = $request->all();
        // check the old data

        //save single image
        $validation = Validator::make(
            $data,
            [
                'username' => 'required',
                'user_email' => 'required',
                'role' => 'required',
                'status' => 'required',
            ]
        );
            if ($validation->fails()) {
                session()->flash('errors', $validation);
                return back();
            }

            $password = Hash::make($data['password']);
            if(!empty($password) || $password != null){
                $password = $password;
            }else{
                $password = Adminsuper::where('id',$id)->value('password');
            }
            Adminsuper::where('id', $id)->update([
                'name' => $data['username'],
                'email' => $data['user_email'],
                'password' => $password ,
                'role' => $data['role'],
                'active' => $data['status'],
            ]);

            session()->flash('success', 'The User has been updated');
            return back();
    }
    public function users_delete($id)
    {
        $user = Adminsuper::find($id);
        if ($user) {
            Adminsuper::where('id', $id)->delete();
            session()->flash('success', 'Your User has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your User is not found');
            return back();
        }
    }
}
