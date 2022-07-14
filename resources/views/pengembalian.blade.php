@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        @if(Auth::user()->role == 2)
                            <h3>Verifikasi Pengembalian</h3>
                        @elseif(Auth::user()->role == 3)
                            <h3>Report Pengembalian</h3>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (session('tambah'))
                        <div class="alert alert-success">
                            {{ session('tambah') }}
                        </div>
                        @endif
                        <div class="modal fade" data-backdrop="false" id="inputModal" tabindex="-1" role="dialog"
                            aria-labelledby="inputModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{url('tambah_lab')}}" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <label for="">Nama Barang</label>
                                            <select name="" id="" class="form-control">
                                                @foreach ($nama_barang as $br)
                                                    <option value="{{$br->nama_barang}}">
                                                        {{$br->nama_barang}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <label for="">Laboratorium</label>
                                            <select name="" id="" class="form-control">
                                                @foreach ($lab as $br)
                                                    <option value="{{$br->nama_lab}}">
                                                        {{$br->nama_lab}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr class="table-success text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Nama Lab</th>
                                    <th scope="col">Jumlah Barang Dipinjam</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($peminjaman as $pj)
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pj->nama_barang }}</td>
                                        <td>{{ $pj->nama_lab }}</td>
                                        <td>{{ $pj->jumlah_pinjam }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pj->tgl_pinjam)->format('d-m-Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($pj->tgl_pengembalian)->format('d-m-Y')}}</td>
                                        <td>{{ $pj->deskripsi }}</td>
                                        <td>
                                            @if($pj->status == 3 && Auth::user()->role == 2)
                                            <a onclick="verifikasi('{{ $pj->id_peminjaman }}', '{{ $pj->nama_barang }}', '{{ $pj->id_barang }}', '{{ $pj->jumlah_pinjam }}', '{{ $pj->nama_lab }}')" class="btn btn-warning text-white"><i class="fas fa-check-circle"></i> Verifikasi</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function verifikasi(id_peminjaman, nama_barang, id_barang, jumlah_pinjam, nama_lab){
            // console.log(nama_barang);
            var token = '{{ csrf_token() }}';
            var my_url = "{{url('/verifikasi_pengembalian')}}";
            var formData = {
                '_token': token,
                'jumlah_pinjam': jumlah_pinjam,
                'id_peminjaman': id_peminjaman,
                'id_barang': id_barang
            };
            if(confirm('Verifikasi Pengembalian Berupa ' + nama_barang + ' Sejumlah ' + jumlah_pinjam + ' Buah/Pcs Oleh ' + nama_lab + ' ?')){
            console.log(nama_barang);
                $.ajax({
                    method: 'POST',
                    url: my_url,
                    data: formData,
                    success: function(resp){
                        alert('Pengembalian Barang Berhasil Diverifikasi!');
                        location.reload();
                    },
                    error: function (resp){
                        console.log(resp);
                    }
                });
            }
    }
    function kembalikan(id_peminjaman, nama_barang){
            // console.log(nama_barang);
            var token = '{{ csrf_token() }}';
            var my_url = "{{url('/kembalikan_barang')}}";
            var formData = {
                '_token': token,
                'id_peminjaman': id_peminjaman
            };
            if(confirm('Apakah Kamu Yakin Akan Mengembalikan ' +nama_barang+ ' Ke Pengurus Inventaris ?')){
            console.log(nama_barang);
                $.ajax({
                    method: 'POST',
                    url: my_url,
                    data: formData,
                    success: function(resp){
                        alert(nama_barang + ' Sudah Dikembalikan!');
                        location.reload();
                    },
                    error: function (resp){
                        console.log(resp);
                    }
                });
            }
    }
</script>
@endsection
