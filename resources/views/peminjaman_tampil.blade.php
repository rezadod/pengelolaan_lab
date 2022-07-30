<thead>
                                <tr class="table-success text-center">
                                    <th class="text-center text-uppercase" scope="col">No</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Barang</th>
                                    <th class="text-center text-uppercase" scope="col">Nama Lab</th>
                                    <th class="text-center text-uppercase" scope="col">Jumlah Dipinjam</th>
                                    <th class="text-center text-uppercase" scope="col">Tanggal Peminjaman</th>
                                    <th class="text-center text-uppercase" scope="col">Status</th>
                                    <th class="text-center text-uppercase" scope="col">Action</th>
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
                                        <span class="badge badge-pill badge-warning">{{ $pj->deskripsi }}</span>
                                    </td>
                                    <td>
                                        @if($pj->status == 1 && Auth::user()->role == 2)
                                        <a onclick="verifikasi('{{ $pj->id_peminjaman }}', '{{ $pj->nama_barang }}', '{{ $pj->id_barang }}', '{{ $pj->jumlah_pinjam }}', '{{ $pj->nama_lab }}')"
                                            class="badge badge-pill badge-success text-white">
                                            VERIFIKASI</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>