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
                        @if (session('hapus'))
                        <div class="alert alert-danger">
                            {{ session('hapus') }}
                        </div>
                        @endif
                        <a href="#" class="btn btn-success btn-sm mb-4 p-1 mr-2 text-white" data-toggle="modal"
                            data-target="#inputModal">Tambah Barang </a>
                        <a href="#" class="btn btn-primary btn-sm mb-4 px-4 py-1 text-white" data-toggle="modal"
                            data-target="#">Print</a>
                        <div class="modal fade" data-backdrop="false" id="inputModal" tabindex="-1" role="dialog"
                            aria-labelledby="inputModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{url('tambah_inventaris')}}" enctype="multipart/form-data"
                                        method="POST">
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

                        <table class="table table-hover" id="data_inven">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah Barang</th>
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
                                    <td>
                                        <img src="{{asset('/barang/'.$in->foto)}}" alt="" width="100" class="img-fluid">
                                    </td>
                                    <td>{{$in->nama_barang}}</td>
                                    <td>{{$in->jumlah_barang}}</td>
                                    <td>
                                        <a onclick="hapus('{{ $in->id }}', '{{ $in->nama_barang }}')"
                                            class="btn btn-danger text-white"><i class="fas fa-trash-alt"></i> Hapus</a>
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

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="inputModalLabel">Hapus Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="bodyHapusModal">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger text-white" onclick="validate_hapus()">Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    function hapus(id){
            var token = '{{ csrf_token() }}';
            $.ajax({
                method: "post",
                url: "{{url('/hapus_data_inventory')}}",
                data: {
                    '_token': token,
                    'id': id
                },
                success: function (resp) {
                    $('#hapusModal').modal('show');
                    $("#bodyHapusModal").html(resp);
                },
                error: function (resp) {
                    console.log(resp);
                    Swal.fire({
                        icon: 'error',
                        text: 'Upss ada yang error, hubungi tim IT!',
                    });
                }
            });
        }


    function validate_hapus(){
        $('#hapus-btn-submit').click();
    }
    // function hapus(id_barang, nama_barang){
    //         // console.log(nama_barang);
    //         var token = '{{ csrf_token() }}';
    //         var my_url = "{{url('/delete_inventaris')}}";
    //         var formData = {
    //             '_token': token,
    //             'id_barang': id_barang
    //         };
    //         if(confirm('Apakah Kamu Yakin Akan Menghapus ' +nama_barang+ ' ?')){
    //         console.log(nama_barang);
    //             $.ajax({
    //                 method: 'POST',
    //                 url: my_url,
    //                 data: formData,
    //                 success: function(resp){
    //                     alert(nama_barang + ' Berhasil Dihapus!');
    //                     location.reload();
    //                 },
    //                 error: function (resp){
    //                     console.log(resp);
    //                 }
    //             });
    //         }
    // }
</script>
@endsection
