<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota;
use App\Models\Kas;

class DashboardController extends KasController
{
    public function info()
    {
        $user = Auth::user();
        $anggota = DB::table('anggota')->where('user_id', $user->id)->select('*')->get();
        $kas = DB::table('kas')->select('nominal','anggota_id')->where('user_id',$user->id)->get();
        $kasout = DB::table('pengeluaran')->where('user_id', $user->id)->get();
        $total = $this->hitungkas($kas);
        $totalout = $this->hitungkas($kasout);
        
        return view('dashboard',compact('total','totalout','anggota','user'));
    }
}
