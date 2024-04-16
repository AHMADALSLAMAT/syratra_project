<?php

namespace App\Http\Controllers\Back_End\Auth;

use App\Models\Adminsuper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function getLogin()
    {

        return view('Back_End.auth.login');
    }
    public function adminsignup()
    {
        return view('Back_End.auth.sginup');
    }
    public function postLogin(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $providedPassword = $data['password'];
        // Passwords match
        // Proceed with your logic here

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $providedPassword])) {
            $user = auth()->guard('admin')->user();

            if ($user->active == 1) {
                session()->flash('success', 'You are logged in successfully. !!!!!');
                return redirect()->route('adminDashboard');
            } else {
                session()->flash('error', 'Your account is not active. Please contact support. !!!!!');
                return back();
            }
        } else {
            // Authentication failed
            session()->flash('error', 'Invalid email and password attemp.');
            return back();
        }
    }
    public function adminsignupPost(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'agrees' => 'required',
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $insertAdmin = new Adminsuper();
        $insertAdmin->name = $data['name'];
        $insertAdmin->email = $data['email'];
        $insertAdmin->password = Hash::make($data['password']);
        $insertAdmin->active = 1;
        $insertAdmin->role = 'supperAdmin';
        $insertAdmin->save();
        session()->flash('success', 'your data has been added successfully !!!!');
        return redirect()->route('adminLogin');
    }
    public function adminlogout(Request $request)
    {
        auth()->guard('admin')->logout();
        session()->flash('success', 'You are logout sucessfully !!!!');
        return redirect(route('adminLogin'));
    }
}
