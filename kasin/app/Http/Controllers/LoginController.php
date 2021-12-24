<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function loginIndex(){
        return view('login.login');
    }


    public function loginAuth(Request $request){
        $valid = $request->validate([
            'email'=> 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($valid)) {
            # code...
            $request->session()->regenerate();
            $nama = Auth::user()->name;
            Alert::success('Login Successful','Welcome '.$nama);
            return redirect()->intended('/dashboard');
        }
        Alert::error('Login Failed','Email or Password is Wrong !');
        return back();
    }


    public function registerIndex(){
        return view('login.register');
    }


    public function registerStore(Request $request){
        
        $validated = $request->validate([
            'name' => 'required|min:5|max:100',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        Alert::success('Registration Success','Please Login');
        return redirect('/login');
    }

    public function logOut(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
