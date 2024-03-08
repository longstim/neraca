<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;


class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Pemasukan";
    
        return view('pages.pemasukan.index_pemasukan', compact('title'));
    }

    public function daftarpemasukan()
    {
        $pemasukan = DB::table('pemasukan')
            ->leftjoin('jenis_pemasukan AS t1', 'pemasukan.jenis_kegiatan', '=', 't1.id')
            ->select('pemasukan.*', 't1.akun AS akun')
            ->orderBy('id', 'desc')
            ->get();
    
        return view('pages.pemasukan.daftar_pemasukan', compact('pemasukan'));
    }

    public function tambahpemasukanrutin()
    {
        $title = "Tambah Pemasukan Rutin";
        
        $id_user = Auth::user()->id;

        $jeniskegiatan=DB::table('jenis_pemasukan')
            ->where('jenis', '=', 'Rutin')
            ->get();
    
        return view('pages.pemasukan.form_tambah-pemasukan-rutin', compact('title', 'jeniskegiatan'));
    }

    public function prosestambahpemasukanrutin(Request $request)
    {
        DB::beginTransaction();

        try 
        {
            $id_user = Auth::user()->id;

            $tgl_pemasukan = $request->input('tgl_pemasukan');
            $newTglPemasukan= Carbon::createFromFormat('d/m/Y', $tgl_pemasukan)->format('Y-m-d');

            $str_jumlah_pemasukan = $request->input('jumlah_pemasukan');
            $jumlah_pemasukan = (double)str_replace('.', '', $str_jumlah_pemasukan);

            $jumlah_huria = (double)$jumlah_pemasukan * 0.45;
            $jumlah_bpsk = (double)$jumlah_pemasukan * 0.55;

            $data = array(
                'tgl_pemasukan' => $newTglPemasukan,
                'jenis_kegiatan' => $request->input('jenis_kegiatan'),
                'jumlah_pemasukan' => $jumlah_pemasukan,
                'jumlah_huria' => $jumlah_huria,
                'jumlah_bpsk' => $jumlah_bpsk,
                'created_by' => $id_user,
            );

            DB::table('pemasukan')->insert($data);

            DB::commit();

        } 
        catch (\Exception $e) 
        {
            DB::rollback();

            return Redirect::to('pemasukan/daftar-pemasukan')->with('failed','Gagal menyimpan data');
        }

        return Redirect::to('pemasukan/daftar-pemasukan')->with('message','Berhasil menyimpan data');
    }

    public function ubahpemasukanrutin($id_pemasukan)
    {
        $title = "Ubah Pemasukan Rutin";

        $pemasukan = DB::table('pemasukan')
                ->where('id', '=', $id_pemasukan)
                ->first();

         $jeniskegiatan=DB::table('jenis_pemasukan')
            ->where('jenis', '=', 'Rutin')
            ->get();

        return view('pages.pemasukan.form_ubah-pemasukan-rutin', compact('title', 'pemasukan', 'jeniskegiatan'));
    }

    public function prosesubahpemasukanrutin(Request $request)
    {
        DB::beginTransaction();

        try 
        {
            $id_user = Auth::user()->id;

            $tgl_pemasukan = $request->input('tgl_pemasukan');
            $newTglPemasukan= Carbon::createFromFormat('d/m/Y', $tgl_pemasukan)->format('Y-m-d');

            $str_jumlah_pemasukan = $request->input('jumlah_pemasukan');
            $jumlah_pemasukan = (double)str_replace('.', '', $str_jumlah_pemasukan);

            $jumlah_huria = (double)$jumlah_pemasukan * 0.45;
            $jumlah_bpsk = (double)$jumlah_pemasukan * 0.55;

            $id_pemasukan = $request->input('id_pemasukan');

            $data = array(
                'tgl_pemasukan' => $newTglPemasukan,
                'jenis_kegiatan' => $request->input('jenis_kegiatan'),
                'jumlah_pemasukan' => $jumlah_pemasukan,
                'jumlah_huria' => $jumlah_huria,
                'jumlah_bpsk' => $jumlah_bpsk,
                'updated_at' => Carbon::now()->toDateTimeString(),
                'updated_by' => $id_user,
            );

            DB::table('pemasukan')->where('id', '=', $id_pemasukan)->update($data);

            DB::commit();

        } 
        catch (\Exception $e) 
        {
            DB::rollback();

            return Redirect::to('pemasukan/daftar-pemasukan')->with('failed','Gagal menyimpan data');
        }

        return Redirect::to('pemasukan/daftar-pemasukan')->with('message','Berhasil menyimpan data');
    }

    public function hapuspemasukanrutin($id_pemasukan)
    {
        DB::beginTransaction();

        try 
        {
            DB::table('pemasukan')->where('id', '=', $id_pemasukan)->delete();

            DB::commit();

        } 
        catch (\Exception $e) 
        {
            DB::rollback();

            return Redirect::to('pemasukan/daftar-pemasukan')->with('failed','Gagal menghapus data');
        }

        return Redirect::to('pemasukan/daftar-pemasukan')->with('message','Berhasil menghapus data');
    }
}
