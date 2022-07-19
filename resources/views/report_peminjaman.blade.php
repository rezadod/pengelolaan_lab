@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                      @if(Auth::user()->role == 1)
                        <h3>Laporan Peminjaman Inventaris</h3>
                        @elseif(Auth::user()->role == 2)
                        <h3>Report User Yang Belum Mengembalikan</h3>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <label for="tanggal_1">Tanggal Dipinjam 1</label>
                                </div>
                                <div>
                                    <input type="date" class="form-control" id="tanggal_1" name="tanggal_1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <label for="tanggal_2">Tanggal Dipinjam 2</label>
                                </div>
                                <div>
                                    <input type="date" class="form-control" id="tanggal_2" name="tanggal_2">
                                </div>
                            </div>
                            <div class="col-2">
                                <div>
                                    <span style="color: white">-</span>
                                </div>
                                <div>
                                    <a class="btn btn-primary btn-md text-white mt-2 btn-rounded mb-4" onclick="cari_data(2)"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <table class="table" id="report_peminjaman">
                            <thead>
                                <tr class="table-success text-center">
                                    <th class="text-center text-uppercase" scope="col">No</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Barang</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Lab</th>
                                    <th class="text-center text-uppercase" scope="col">Jumlah Barang Dipinjam</th>
                                    <th class="text-center text-uppercase" scope="col">Tanggal Peminjaman</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Peminjam</th>
                                    <th class="text-center text-uppercase" scope="col">Status</th>
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
                                    <td>
                                      {{ $pj->name }}
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-info">{{ $pj->deskripsi }}</span>
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
    function verifikasi(id_peminjaman, nama_barang, id_barang, jumlah_pinjam, nama_lab) {
        // console.log(nama_barang);
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/verifikasi_pengembalian')}}";
        var formData = {
            '_token': token,
            'jumlah_pinjam': jumlah_pinjam,
            'id_peminjaman': id_peminjaman,
            'id_barang': id_barang
        };
        if (confirm('Verifikasi Pengembalian Berupa ' + nama_barang + ' Sejumlah ' + jumlah_pinjam + ' Buah/Pcs Oleh ' +
                nama_lab + ' ?')) {
            console.log(nama_barang);
            $.ajax({
                method: 'POST',
                url: my_url,
                data: formData,
                success: function (resp) {
                    alert('Pengembalian Barang Berhasil Diverifikasi!');
                    location.reload();
                },
                error: function (resp) {
                    console.log(resp);
                }
            });
        }
    }

    function kembalikan(id_peminjaman, nama_barang, id_barang, jumlah_pinjam) {
        // console.log(nama_barang);
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/kembalikan_barang')}}";
        var formData = {
            '_token': token,
            'jumlah_pinjam': jumlah_pinjam,
            'id_peminjaman': id_peminjaman,
            'id_barang': id_barang
        };
        if (confirm('Apakah Kamu Yakin Akan Mengembalikan ' + nama_barang + ' Ke Pengurus Inventaris ?')) {
            console.log(nama_barang);
            $.ajax({
                method: 'POST',
                url: my_url,
                data: formData,
                success: function (resp) {
                    alert(nama_barang + ' Sudah Dikembalikan!');
                    location.reload();
                },
                error: function (resp) {
                    console.log(resp);
                }
            });
        }
    }

</script>
@endsection
