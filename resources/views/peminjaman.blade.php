@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Ajukan Peminjaman</h3>
                    </div>
                    <div class="card-body">
                        @if (session('tambah'))
                        <div class="alert alert-success">
                            {{ session('tambah') }}
                        </div>
                        @endif
                        <a href="#" class="btn btn-success btn-sm mb-4 p-1 text-white" data-toggle="modal"
                            data-target="#inputModal">Ajukan Peminjaman</a>
                        <div class="modal fade" data-backdrop="false" id="inputModal" tabindex="-1" role="dialog"
                            aria-labelledby="inputModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{url('ajukan_peminjaman')}}" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Peminjaman Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <label for="ajukan_peminjaman">Nama Barang</label>
                                            <select name="barang" id="barang" class="form-control">
                                                <option value="">--PILIH BARANG--</option>
                                                @foreach ($nama_barang as $br)
                                                    <option value="{{$br->id}}">
                                                        {{$br->nama_barang}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <label for="lab">Laboratorium</label>
                                            <select name="lab" id="lab" class="form-control">
                                                <option value="">--PILIH LABORATORIUM--</option>
                                                @foreach ($lab as $br)
                                                    <option value="{{$br->id}}">
                                                        {{$br->nama_lab}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <label for="jumlah">Jumlah Barang Dipinjam</label>
                                            <input type="number" class="form-control" name="jumlah" id="jumlah">
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
                                <tr class="table-success">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Nama Lab</th>
                                    <th scope="col">Jumlah Barang Dipinjam</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($peminjaman as $pj)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pj->nama_barang }}</td>
                                        <td>{{ $pj->nama_lab }}</td>
                                        <td>{{ $pj->jumlah_pinjam }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pj->tgl_pinjam)->format('d-m-Y')}}</td>
                                        <td>
                                            <a onclick="kembalikan('{{ $pj->id_peminjaman }}', '{{ $pj->nama_barang }}', '{{ $pj->id_barang }}', '{{ $pj->jumlah_pinjam }}')" class="btn btn-info text-white"><i class="fas fa-undo-alt"></i> Kembalikan</a>
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
    function kembalikan(id_peminjaman, nama_barang, id_barang, jumlah_pinjam){
            // console.log(nama_barang);
            var token = '{{ csrf_token() }}';
            var my_url = "{{url('/kembalikan_barang')}}";
            var formData = {
                '_token': token,
                'jumlah_pinjam': jumlah_pinjam,
                'id_peminjaman': id_peminjaman,
                'id_barang': id_barang
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
