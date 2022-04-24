<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function  getLogin(){

        return view('admin.auth.login');
    }

    public function save(){

        $admin = new Admin();
        $admin -> name ="Youssef";
        $admin -> email ="inscrire@gmail.com";
        $admin -> role ="gestion";
        $admin -> password = bcrypt("12345678");
        $admin -> save();

    }

    public function login(Request $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            $request->session()->regenerate();
            // notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('admin.dashboard');
        }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'une erreur detecte']);
    }

    
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('get.admin.login');
    }
}
