<?php

namespace App\Http\Controllers\Front_End\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class FrontAuthController extends Controller
{
    public function review(Request $request){
        $data = $request->all();
        if(empty($data['hotel_id']) || $data['hotel_id'] == null){
            $package_id =$data['package_id'];
            $hotel_id =null;

        }else{
            $hotel_id =$data['hotel_id'];
            $package_id =null;
        }
        if(empty($data['user_id']) || $data['user_id'] == null){
            session()->flash('error', 'you have to register first');
            return back();
        }
        $userData = User::find($data['user_id']);
        $review = new Review();
        $review->user_id = $data['user_id'];
        $review->hotel_id = $hotel_id;
        $review->package_id = $package_id;
        $review->review_name = $userData->name;
        $review->review_email =$userData->email;
        $review->star_review = $data['star_review'];
        $review->message = $data['message'];
        $review->save();
        session()->flash('success', 'Tank you for your review, it has been sent successfully . !!!!!');
        return back();

    }
    public function front_login(){
        return view('Front_End.pages.auth.login');
    }

    public function front_login_post(Request $request){

        $data = $request->all();
        if($data['form_type'] == 'signin'){
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
            if (Auth::attempt(['email' => $data['email'], 'password' => $providedPassword])) {
                $user = auth()->user();
                if ($user->active == 1) {
                    session()->flash('success', 'You are logged in successfully. !!!!!');
                    return redirect()->intended(); // Redirect back to the previous page
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

        if($data['form_type'] == 'signup'){
            $data = $request->all();
            $validation = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phone' => 'required',
            ]);
            if ($validation->fails()) {
                return back()->withErrors($validation)->withInput();
            }
            $insertAdmin = new User();
            $insertAdmin->name = $data['name'];
            $insertAdmin->email = $data['email'];
            $insertAdmin->phone = $data['phone'];
            $insertAdmin->password = Hash::make($data['password']);
            $insertAdmin->active = 1;
            $insertAdmin->role = 'user';
            $insertAdmin->save();
            session()->flash('success', 'your data has been added successfully !!!!');
            return redirect()->back();
        }
    }
    public function userlogout()
    {
        auth()->logout();
        session()->flash('success', 'You are logout sucessfully !!!!');
        return redirect()->back();
    }
}
