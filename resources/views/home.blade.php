@extends('layouts.layout')

@section('content')


<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Kelola Inventaris</h3>
                    </div>
                    <div class="card-body">
                        @if (session('tambah'))
                        <div class="alert alert-success">
                            {{ session('tambah') }}
                        </div>
                        @endif
                        <a href="#" class="btn btn-success btn-sm mb-4 p-1 text-white" data-toggle="modal"
                            data-target="#inputModal">Tambah Barang </a>
                        <div class="modal fade" data-backdrop="false" id="inputModal" tabindex="-1" role="dialog"
                            aria-labelledby="inputModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{url('tambah_inventaris')}}" enctype="multipart/form-data" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <label for="">Nama Barang</label>
                                            <input type="text" name="nama_barang" id="nama_barang"
                                                placeholder="Nama Barang Barang" class="form-control">
                                            <br>
                                            <label for="">Jumlah Barang</label>
                                            <input type="text" name="jumlah" id="jumlah"
                                                placeholder="Masukkan Kuantiti Barang" class="form-control">
                                            <label for="">Foto Barang</label>
                                            <input type="file" name="foto" id="foto" class="form-control">
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
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Terkahir Dirubah</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no =1;
                                @endphp
                                @foreach ($inventaris as $in)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$in->nama_barang}}</td>
                                    <td>{{$in->jumlah_barang}}</td>
                                    <td>
                                        <img src="{{asset('foto/'.$in->foto)}}" alt="" width="200" class="img-fluid" >
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
@endsection
