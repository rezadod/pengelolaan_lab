@extends('layouts.layout')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Laporan Data User</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="lab">
                            <thead>
                                <tr class="table-success">
                                    <th class="text-center text-uppercase" scope="col">No</th>
                                    <th class="text-left text-uppercase" scope="col">Nama </th>
                                    <th class="text-left text-uppercase" scope="col">Email</th>
                                    <th class="text-center text-uppercase" scope="col">Jenis Kelamin</th>
                                    <th class="text-center text-uppercase" scope="col">Tanggal Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($user as $u)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-left">{{ $u->name }}</td>
                                    <td class="text-left">{{ $u->email }}</td>
                                    <td class="text-center">{{Str::of($u->jenis_kelamin)->limit(110)->upper() }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($u->updated_at)->format('d-m-Y')}}
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
