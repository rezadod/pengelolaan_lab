<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inventaris = DB::table('inventaris')->SELECT('*')->GET();
        return view('home',compact('inventaris'));
    }
    public function tambah_inventaris(Request $request)

    {
        $nama=$request->nama_barang;
        $jumlah=$request->jumlah;
        $foto_barang = $request->file('foto');
        $namaBuktiTf = uniqid('barang_');
        $eksetensiBuktiTf = $foto_barang->getClientOriginalExtension();
        $namaBuktiTfBaru = $namaBuktiTf. '.' .$eksetensiBuktiTf;
        $direktoriUploadBuktiTf = public_path().'/barang';
        $foto_barang->move($direktoriUploadBuktiTf, $namaBuktiTfBaru);
        DB::table('inventaris')->insert([
            'nama_barang'=>$nama,
            'jumlah_barang'=>$jumlah,
            'foto'=>$namaBuktiTfBaru,

        ]);
        return redirect()->back()->with('tambah','Data Berhasil Ditambahkan');
    }
     public function kelola_lab()
    {
        $lab = DB::table('lab')->SELECT('*')->GET();
        return view('lab',compact('lab'));
    }
    public function tambah_lab(Request $request)

    {
        $nama=$request->nama_lab;
        
        DB::table('lab')->insert([
            'nama_lab'=>$nama,
        
        ]);
        return redirect()->back()->with('tambah','Data Berhasil Ditambahkan');
    }
     public function peminjaman()
    {  
        $nama_barang = DB::table('inventaris')->SELECT('nama_barang','jumlah_barang')->GET();
        $lab = DB::table('lab')->SELECT('nama_lab')->GET();
        $peminjaman = DB::table('peminjaman')->SELECT('*')->GET();
        return view('peminjaman',compact('nama_barang','lab','peminjaman'));
    }
}
