<thead>
    <tr class="table-success text-center text-uppercase">
        <th scope="col">No</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Nama Lab</th>
        <th scope="col">Jumlah Barang Dipinjam</th>
        <th scope="col">Tanggal Peminjaman</th>
        <th scope="col">Tanggal Pengembalian</th>
        <th scope="col">Status</th>
    </tr>
</thead>
<tbody>
    @php
    $no = 1;
    @endphp
    @foreach ($peminjaman as $pj)
    <tr class="">
        <td class="text-center">{{ $no++ }}</td>
        <td>{{ $pj->nama_barang }}</td>
        <td>{{ $pj->nama_lab }}</td>
        <td class="text-center">{{ $pj->jumlah_pinjam }}</td>
        <td>{{ \Carbon\Carbon::parse($pj->tgl_pinjam)->format('d-m-Y')}}</td>
        <td>{{ \Carbon\Carbon::parse($pj->tgl_pengembalian)->format('d-m-Y')}}</td>
        <td>{{ $pj->deskripsi }}</td>
    </tr>
    @endforeach
</tbody>