<x-layout>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Search Bar dan Dropdown -->
    <div class="row mb-4 justify-content-end">
        <h3 class="col-md-5 me-auto">Log Paket</h3>
        <div class="col-md-1 mb-3 text-end">
            <a href="{{ route('paket.create') }}">
                <button class="btn btn-danger ">+</button>
            </a>
        </div>
        <div class="col-md-3">
            <form action="{{ route('paket.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari disini"
                        value="{{ request('search') ?? '' }}">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <form action="{{ route('paket.index') }}" method="GET">
                <select class="form-select" name="filter_sort" onchange="this.form.submit()">
                    <option disabled @selected(!request('filter_sort'))>Urutkan</option>
                    <option value="latest"@selected(request('filter_sort') == 'newest')>Terbaru</option>
                    <option value="oldest"@selected(request('filter_sort') == 'oldest')>Terlama</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Penerima</th>
                                    <th scope="col">PJ Penerima</th>
                                    <th scope="col">PJ Penyerahan</th>
                                    <th scope="col">Kamar</th>
                                    <th scope="col">Waktu Tiba</th>
                                    <th scope="col">Waktu Diambil</th>
                                    <th scope="col">Status Pengembalian</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pakets as $paket)
                                    @php
                                        $datetimeT = $paket->waktu_tiba;
                                        $parts = explode(' ', $datetimeT);
                                        $tanggalT = $parts[0];
                                        $waktuT = $parts[1];

                                        $datetimeD = $paket->waktu_diambil;
                                        if ($datetimeD) {
                                            $parts = explode(' ', $datetimeD);
                                            $tanggalD = $parts[0]; // Tanggal
                                            $waktuD = $parts[1]; // Waktu
                                        } else {
                                            $tanggalD = '-';
                                            $waktuD = ' ';
                                        }
                                    @endphp
                                    <tr>
                                        <td><a href="{{ route('paket.detailGambar', $paket->paket_id) }}"><img
                                                    src="{{ asset($paket->gambar) }}" alt="Gmbr" width="50"></a>
                                        </td>
                                        <td>{{ $paket->dormitizen->nama }}</td>
                                        <td>{{ $paket->penerimaPaket->nama }}</td>
                                        <td>{{ $paket->penyerahanPaket ? $paket->penyerahanPaket->nama : '-' }}</td>
                                        <td>{{ $paket->dormitizen->kamar->nomor }}</td>
                                        <td>{{ $tanggalT }}<br>{{ $waktuT }}</td>
                                        <td>{{ $tanggalD }}<br>{{ $waktuD }}</td>
                                        <td>
                                            @if ($paket['status_pengambilan'] == 'sudah')
                                                <span
                                                    class="border rounded border-primary p-1 text-primary">{{ $paket['status_pengambilan'] }}</span>
                                            @else
                                                <span
                                                    class="border rounded border-danger p-1 text-danger">{{ $paket['status_pengambilan'] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('paket.destroy', $paket) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus log ini?')"><i
                                                        class="align-middle" data-feather="trash-2"></i> </button>
                                            </form>
                                            <a href="{{ route('paket.edit', $paket->paket_id) }}">
                                                <button class="btn btn-warning "><i class="align-middle"
                                                        data-feather="edit"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    {{ $pakets->appends(request()->query())->links('pagination::bootstrap-5') }}

</x-layout>
