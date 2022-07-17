@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Laporan Data Laboratorium</h3>
                    </div>
                    <div class="card-body">
                         <a href="#" class="btn btn-primary btn-sm mb-4 px-4 py-1 text-white" data-toggle="modal"
                            data-target="#">Print</a>

                        <table class="table table-hover" id="lab">
                            <thead>
                                <tr class="table-success">
                                    <th class="text-center text-uppercase" scope="col">No</th>
                                    <th class="text-left text-uppercase" scope="col">Nama Lab</th>
                                    <th class="text-center text-uppercase" scope="col">Tanggal Terakhir Diupdate</th>
                                    <th class="text-center text-uppercase" scope="col">Tanggal Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($lab as $l)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-left">{{ $l->nama_lab }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($l->created_at)->format('d-m-Y')}}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($l->updated_at)->format('d-m-Y')}}</td>
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
