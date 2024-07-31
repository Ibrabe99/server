<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function getLogin()
    {
        if(!empty(Auth::check())){
            return redirect('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {

        // $value = $request->session()->get('key');
        $remember_me = !empty($request->remember) ? true : false;

        // if(Auth::attempt(['email'=> $request->email , 'password'=>$request->password],$remember_me)){
        //     return redirect('admin.dashboard');
        // }
        // else {
        //     return redirect()->back()->with('erorr','فيه مشكلة');
        // }
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('admin.dashboard');
        }
            // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
            return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);


            // return view('admin.includes.mian_sidebar',compact('admins'));
    }



}
