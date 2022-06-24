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
                        <table class="table">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">No</th>

                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama </th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tanggal Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($user as $u)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>FOTo</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{Str::of($u->jenis_kelamin)->limit(110)->upper() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($u->updated_at)->format('d-m-Y')}}</td>
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
