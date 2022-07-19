@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Kelola Laboratorium</h3>
                    </div>
                    <div class="card-body">
                        @if (session('tambah'))
                        <div class="alert alert-success">
                            {{ session('tambah') }}
                        </div>
                        @endif
                        <a href="#" class="btn btn-success btn-sm mb-4 p-1 mr-2 text-white" data-toggle="modal"
                            data-target="#inputModal">Tambah Laboratorium</a>
                        <div class="modal fade" data-backdrop="false" id="inputModal" tabindex="-1" role="dialog"
                            aria-labelledby="inputModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{url('tambah_lab')}}" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Laboratorium</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <label for="">Nama Laboratorium</label>
                                            <input type="text" name="nama_lab" id="nama_lab"
                                                placeholder="Masukkan Nama Laboratorium" class="form-control">
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

                        <table class="table table-hover" id="kelola_lab">
                            <thead>
                                <tr class="table-success">
                                    <th class="text-center text-uppercase" scope="col">No</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Barang</th>
                                    <th class="text-center text-uppercase" scope="col">Terkahir Diedit</th>
                                    <th class="text-center text-uppercase" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no =1;
                                @endphp
                                @foreach ($lab as $in)
                                <tr class="text-center">
                                    <td>{{$no++}}</td>
                                    <td>{{$in->nama_lab}}</td>
                                    <td>{{$in->created_at}}</td>
                                    <td>

                                        <a onclick="modal_edit({{ $in->id }})"
                                            class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i>
                                            EDIT</a>
                                        <a onclick="hapus('{{ $in->id }}', '{{ $in->nama_lab }}')"
                                            class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i>
                                            HAPUS</a>

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
<!-- Modal -->
<div class="modal fade" data-backdrop="false" id="modal_detail" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="refresh_data"></div>
        </div>
    </div>
</div>
<script>
    function modal_edit(id) {
        var jenis = 'Izin';
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/edit_lab')}}";
        var formData = {
            '_token': token,
            'id': id
        };
        $.ajax({
            method: 'POST',
            url: my_url,
            data: formData,
            // dataType: 'json',
            success: function (resp) {
                $('#modal_detail').modal('show');
                $("#refresh_data").html(resp);
            },
            error: function (resp) {
                console.log(resp);
            }
        });
    };

    function hapus(id_lab, nama_lab) {
        // console.log(nama_lab);
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/delete_lab')}}";
        var formData = {
            '_token': token,
            'id_lab': id_lab
        };
        if (confirm('Apakah Kamu Yakin Akan Menghapus ' + nama_lab + ' ?')) {
            console.log(nama_lab);
            $.ajax({
                method: 'POST',
                url: my_url,
                data: formData,
                success: function (resp) {
                    alert(nama_lab + ' Berhasil Dihapus!');
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
