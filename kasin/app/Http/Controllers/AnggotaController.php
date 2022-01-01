<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{

    public function user(){
        $user = Auth::user();
        return $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $test = Anggota::find(1);
        // $test2 = DB::table('anggota')->select('nama')->get();
        // dd($test2);
        // dd($test->kas[0]->anggota);

        $user = $this->user();
        $data = Anggota::where('user_id', $user->id)->get();
        return view('anggota.all-anggota',compact('data','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'jk' => $request->jk,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'user_id' => $this->user()->id
        ];

        Anggota::insert($data);
        Alert::success('Add Data Success','Data Berhasil Di Tambah');
        return back();
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
        $old = Anggota::find($id);
        $data = [
            'nama' => $request->nama ?? $old->nama,
            'jk' => $request->jk ?? $old->jk,
            'no_hp' => $request->no_hp ?? $old->no_hp,
            'status' => $request->status ?? $old->status,
            'user_id' => $old->user_id
        ];

        $new = $old->update($data);
        Alert::success('Update Data Success','Data Berhasil Di Edit');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::find($id)->delete();
        Alert::success('Delete Data Success','Data Berhasil Di Hapus');
        return back();
    }

    
}
