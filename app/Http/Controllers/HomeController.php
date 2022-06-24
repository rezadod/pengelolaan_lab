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
    public function kelola_inventaris()
    {
        $inventaris = DB::table('inventaris')->SELECT('*')->GET();
        return view('home',compact('inventaris'));
    }
    // public function index()
    // {
    //     $inventaris = DB::table('inventaris')->SELECT('*')->GET();
    //     return view('home',compact('inventaris'));
    // }
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
        $user_peminjam = Auth::user()->id;
        $nama_barang = DB::table('inventaris')->SELECT('id', 'nama_barang','jumlah_barang')->GET();

        $lab = DB::table('lab')->SELECT('id', 'nama_lab')->GET();

        $peminjaman = DB::table('peminjaman as a')
                        ->LEFTJOIN('inventaris as b', 'a.nama_barang', 'b.id')
                        ->LEFTJOIN('lab as c', 'a.lab', 'c.id')
                        ->LEFTJOIN('users as d', 'a.peminjam', 'd.id')
                        ->LEFTJOIN('status as e', 'a.status', 'e.id')
                        ->SELECT(
                            'a.id as id_peminjaman',
                            'a.jumlah_pinjam',
                            'a.tgl_pinjam',
                            'b.id as id_barang',
                            'b.nama_barang',
                            'c.nama_lab',
                            'd.name',
                            'e.deskripsi'
                        )
                        ->WHERE('a.peminjam', $user_peminjam)
                        ->WHERE('a.status', 1)
                        ->GET();
        // dd($peminjaman);
        return view('peminjaman',compact('nama_barang','lab','peminjaman'));
    }

    public function ajukan_peminjaman(Request $request)
    {
        $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lab = $request->lab;
        $id_barang = $request->barang;
        $jumlah = $request->jumlah;
        $peminjam = Auth::user()->id;
        // INSERT DATA PEMINJAMAN
        DB::table('peminjaman')
            ->insert([
                'tgl_pinjam' => $date_now,
                'jumlah_pinjam' => $jumlah,
                'lab' => $lab,
                'nama_barang' => $id_barang,
                'peminjam' => $peminjam,
                'status' => 1
            ]);
        // UPDATE JUMLAH BARANG
        $jml_terpinjam_now = DB::table('inventaris')->select('jumlah_yang_dipinjam', 'nama_barang')->where('id', $id_barang)->first();
        $jml_dipinjam_new = $jml_terpinjam_now->jumlah_yang_dipinjam + $jumlah;
        DB::table('inventaris')
            ->where('id', $id_barang)
            ->update([
                'jumlah_yang_dipinjam' => $jml_dipinjam_new
            ]);
        // get lab
        $n_lab = DB::table('lab')->select('nama_lab')->where('id', $lab)->first();
        $pesan = $jml_terpinjam_now->nama_barang. ' Berhasil Dipinjam Oleh ' . $n_lab->nama_lab . ' Sejumlah = ' . $jumlah . ' buah';
        return redirect()->back()->with('tambah', $pesan);
    }

    public function pengembalian()
    {  
        $user_peminjam = Auth::user()->id;
        $nama_barang = DB::table('inventaris')->SELECT('id', 'nama_barang','jumlah_barang')->GET();

        $lab = DB::table('lab')->SELECT('id', 'nama_lab')->GET();

        $peminjaman = DB::table('peminjaman as a')
                        ->LEFTJOIN('inventaris as b', 'a.nama_barang', 'b.id')
                        ->LEFTJOIN('lab as c', 'a.lab', 'c.id')
                        ->LEFTJOIN('users as d', 'a.peminjam', 'd.id')
                        ->LEFTJOIN('status as e', 'a.status', 'e.id')
                        ->SELECT(
                            'a.id as id_peminjaman',
                            'a.jumlah_pinjam',
                            'a.tgl_pinjam',
                            'a.tgl_pengembalian',
                            'b.nama_barang',
                            'c.nama_lab',
                            'd.name',
                            'e.deskripsi'
                        )
                        ->WHERE('a.peminjam', $user_peminjam)
                        ->WHERE('a.status', 2)
                        ->GET();
        // dd($peminjaman);
        return view('pengembalian',compact('nama_barang','lab','peminjaman'));
    }

    public function kembalikan_barang(Request $request)
    {
        $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $id_peminjaman = $request->id_peminjaman;
        $jumlah_pinjam = $request->jumlah_pinjam;
        $id_barang = $request->id_barang;

        $jml_terpinjam = DB::table('inventaris')->select('jumlah_yang_dipinjam')->where('id', $id_barang)->first();
        $jml_dikembalikan = $jml_terpinjam->jumlah_yang_dipinjam - $jumlah_pinjam;
        // UPDATE JUMLAH BARANG
        
        DB::table('inventaris')
            ->where('id', $id_barang)
            ->update([
                'jumlah_yang_dipinjam' => $jml_dikembalikan
            ]);
        // UPDATE STATUS PINJAMAN
        DB::table('peminjaman')
            ->where('id', $id_peminjaman)
            ->update([
                'tgl_pengembalian' => $date_now,
                'status' => 2
            ]);
        
    }
     public function report_lab()
    {
        $lab = DB::table('lab')->SELECT('*')->GET();
        return view('report_lab',compact('lab'));
    }
   

      public function report_data_user()
    {
        $user = DB::table('users')->SELECT('*')->GET();
        return view('report_data_user',compact('user'));
    }
}
