<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        $pemasukan = DB::table('pemasukan')
            ->leftjoin('jenis_pemasukan AS t1', 'pemasukan.jenis_kegiatan', '=', 't1.id')
            ->select('pemasukan.*', 't1.akun AS akun')
            ->orderBy('pemasukan.id', 'desc')
            ->limit(5)
            ->get();

        $pengeluaran = DB::table('pengeluaran')
            ->leftjoin('jenis_pengeluaran AS t1', 'pengeluaran.jenis_kegiatan', '=', 't1.id')
            ->select('pengeluaran.*', 't1.akun AS akun')
            ->orderBy('pengeluaran.id', 'desc')
            ->limit(5)
            ->get();

        return view('home', compact('pemasukan', 'pengeluaran'));
    }
}
