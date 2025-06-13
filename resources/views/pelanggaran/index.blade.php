<x-layout>
    <!-- Search Bar dan Dropdown -->
    <div class="row mb-4 justify-content-end">
        <h3 class="col-md-5 me-auto">Pelanggaran</h3>
        <div class="col-md-3">
            <form action="{{ route('pelanggaran.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari disini"
                        value="{{ request('search', '') }}">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <form action="{{ route('pelanggaran.index') }}" method="GET">
                <select class="form-select" name="filter_sort" onchange="this.form.submit()">
                    <option disabled {{ request('filter_sort') ? '' : 'selected' }}>Urutkan</option>
                    <option value="most" {{ request('filter_sort') == 'most' ? 'selected' : '' }}>Most</option>
                    <option value="least" {{ request('filter_sort') == 'least' ? 'selected' : '' }}>Least</option>
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
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Kamar</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Banyak Pelanggaran</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggarans as $pelanggaran)
                                <tr>
                                    <td>{{ $pelanggaran->dormitizen->kamar->nomor}}</td>
                                    <td>{{ $pelanggaran->dormitizen->nama}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="progress col-6 p-0">
                                                <div class="progress progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ ($pelanggaran->total_pelanggaran / 9) * 100 }}%"
                                                    aria-valuenow="{{ ($pelanggaran->total_pelanggaran / 9) * 100 }}">
                                                </div>
                                            </div>
                                            <div class="col-6">{{ $pelanggaran->total_pelanggaran }}/9</div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('kamar.detail', [$pelanggaran->dormitizen->kamar->kamar_id, 'from' => 'pelanggaran']) }}"
                                            class="btn btn-info">Detail</a>
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
    {{ $pelanggarans->appends(request()->query())->links('pagination::bootstrap-5') }}
</x-layout>