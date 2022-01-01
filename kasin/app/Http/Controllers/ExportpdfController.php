<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Excel;
use App\Models\Anggota;

class ExportpdfController extends Controller
{
    //
    function hitungkas($nominal){
        $total = 0 ;
        foreach($nominal as $n){
            $total = $total + $n->nominal;
        };
        return $total;
    }

    public function exportpdfanggota(){
        $user = Auth::user();
        $data = DB::table('anggota')->select('nama','no_hp','jk','status')->where('user_id', $user->id)->get();
        $pdf = PDF::loadview('pdf.anggota-pdf',['data'=>$data,'user'=>$user]);
        return $pdf->download('data-anggota.pdf');
    }

    public function exportpdfkasout(Request $request){
        
        if($request->filled('from')){
            if($request->filled('to')){
                $user = Auth::user();
                $data = DB::table('pengeluaran')->select('nominal','tgl_pengeluaran','keterangan')
                        ->whereBetween('tgl_pengeluaran',[$request->from,$request->to])
                        ->where('user_id', $user->id)->get();
                $total = $this->hitungkas($data);
                $pdf = PDF::loadview('pdf.kasout-pdf',['data'=>$data,'user'=>$user,'total'=>$total]);

                return $pdf->download('data-pengeluaran.pdf');
        }else{
            Alert::error('Gagal','Tanggal Awal dan Akhir Harus Di Isi Atau Kosong');
            return back();
        }
        }else {
            if($request->filled('to')){
                Alert::error('Gagal','Tanggal Awal dan Akhir Harus Di Isi Atau Kosong');
                return back();
            }else{
                $user = Auth::user();
                $data = DB::table('pengeluaran')->select('nominal','tgl_pengeluaran','keterangan')
                            ->where('user_id', $user->id)->get();
                $total = $this->hitungkas($data);
                $pdf = PDF::loadview('pdf.kasout-pdf',['data'=>$data,'user'=>$user,'total'=>$total]);

                return $pdf->download('data-pengeluaran.pdf');
            }
        }
    }

    public function exportpdfkasin(){
        $user = Auth::user();
        $anggota = DB::table('anggota')->where('user_id', $user->id)->select('id','nama')->get();
        $kas = DB::table('kas')->select('nominal','anggota_id')->where('user_id',$user->id)->get();
        $kasout = DB::table('pengeluaran')->where('user_id', $user->id)->get();
        $total = $this->hitungkas($kas);
        $totalout = $this->hitungkas($kasout);
        $pdf = PDF::loadview('pdf.kasin-pdf',compact('user','anggota','kas','total','kasout','totalout'));

        return $pdf->download('data-pembayaran-anggota.pdf');
    }

    public function exportpdfkasincustom(Request $request, $id ){
        if($request->filled('from')){
            if($request->filled('to')){
                $user = Auth::user();
                $anggota = Anggota::find($id);
                $kas = DB::table('kas')->whereBetween('tgl_bayar',[$request->from,$request->to])
                                    ->where('anggota_id',$id)
                                    ->get();
                $total = $this->hitungkas($kas);
                $pdf = PDF::loadview('pdf.detail-kasin-pdf',compact('user','kas','total','anggota'));
                return $pdf->download('detail-pembayaran-'.$anggota->nama.'.pdf');
            }else{
                Alert::error('Gagal','Tanggal Awal dan Akhir Harus Di Isi Atau Kosong');
                return back();
            }
        }else {
            if($request->filled('to')){
                Alert::error('Gagal','Tanggal Awal dan Akhir Harus Di Isi Atau Kosong');
                return back();
            }else{
                $user = Auth::user();
                $anggota = Anggota::find($id);
                $kas = DB::table('kas')->where('anggota_id', $id)->get();
                $total = $this->hitungkas($kas);
                $pdf = PDF::loadview('pdf.detail-kasin-pdf',compact('user','kas','total','anggota'));
                return $pdf->download('detail-pembayaran-'.$anggota->nama.'.pdf');
            }
        }
    }
}
