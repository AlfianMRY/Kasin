<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        $active = 'dashboard';
        $title = 'Dashboard';
        return view('profil', compact('active', 'title', 'user'));
    }
}
