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
                                <tr class="table-success">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Nama Lab</th>
                                    <th scope="col">Jumlah Barang Dipinjam</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Pengembalian</th>
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
                                        <td>{{ \Carbon\Carbon::parse($pj->tgl_pengembalikan)->format('d-m-Y')}}</td>
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
