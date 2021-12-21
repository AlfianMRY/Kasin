<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Anggota;
use App\Models\Kas;

class KasController extends Controller
{
    function hitungkas($nominal){
        $total = 0 ;
        foreach($nominal as $n){
            $total = $total + $n->nominal;
        };
        return $total;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $anggota = DB::table('anggota')->where('user_id', $user->id)->select('id','nama')->get();
        $kas = DB::table('kas')->select('nominal','anggota_id')->get();
        $kasout = DB::table('pengeluaran')->where('user_id', $user->id)->get();
        $total = $this->hitungkas($kas);
        $totalout = $this->hitungkas($kasout);
        return view('kas.all-kas',compact('user','anggota','kas','total','kasout','totalout'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $anggota = DB::table('anggota')->find($id);
        $kas = Kas::where('anggota_id', $id)->get();
        $total = $this->hitungkas($kas);
        return view('kas.detail-kas',compact('user','anggota','kas','total'));
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
        $data = [
            'nominal' => $request->nominal,
            'tgl_bayar' => $request->tgl_bayar,
            'keterangan' => $request->keterangan,
            'anggota_id' => $id
        ];
        Kas::create($data);
        Alert::success('Berhasil','Kas Berhasil Ditambah');
        return redirect()->back();
    }

    public function pengeluaran(Request $request, $id) 
    {
        $data = [
            'nominal' => $request->nominal,
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'keterangan' => $request->keterangan,
            'user_id' => $id
        ];
        DB::table('pengeluaran')->insert($data);
        Alert::success('Berhasil','Pengeluaran Berhasil DiCatat');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
