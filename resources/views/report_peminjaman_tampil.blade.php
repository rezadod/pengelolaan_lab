

    <thead>
        <tr class="table-success text-center">
            <th class="text-center text-uppercase" scope="col">No</th>
            <th class="text-center text-uppercase" scope="col">Nama Barang</th>
            <th class="text-center text-uppercase" scope="col">Nama Lab</th>
            <th class="text-center text-uppercase" scope="col">Jumlah Barang Dipinjam</th>
            <th class="text-center text-uppercase" scope="col">Tanggal Peminjaman</th>
            <th class="text-center text-uppercase" scope="col">Nama Peminjam</th>
            <th class="text-center text-uppercase" scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($peminjaman as $pj)
        <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td>{{ $pj->nama_barang }}</td>
            <td>{{ $pj->nama_lab }}</td>
            <td>{{ $pj->jumlah_pinjam }}</td>
            <td>{{ \Carbon\Carbon::parse($pj->tgl_pinjam)->format('d-m-Y')}}</td>
            <td>
            {{ $pj->name }}
            </td>
            <td>
                <span class="badge badge-pill badge-info">{{ $pj->deskripsi }}</span>
        </tr>
        @endforeach
    </tbody>
