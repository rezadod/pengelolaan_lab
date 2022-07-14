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
                        <table class="table" id="lab">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">No</th>

                                    <th scope="col">Nama Lab</th>

                                    <th scope="col">Tanggal Terakhir Diupdate</th>
                                    <th scope="col">Tanggal Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($lab as $l)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $l->nama_lab }}</td>

                                    <td>{{ \Carbon\Carbon::parse($l->created_at)->format('d-m-Y')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($l->updated_at)->format('d-m-Y')}}</td>
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
