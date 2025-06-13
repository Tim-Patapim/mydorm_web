<x-layout>
    <!-- Search Bar dan Dropdown -->
    <div class="row mb-4 justify-content-end">
        <h3 class="col-md-5 me-auto">Detail dormitizen gedung {{ auth()->user()->gedung->nama }}</h3>
        <div class="col-md-1 mb-3 text-end">
            <a href="{{ route('paket.create') }}">
                <button class="btn btn-danger ">+</button>
            </a>
        </div>
        <div class="col-md-3">
            <form action="{{ route('dormitizen.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari disini"
                        value="{{ request('search') ?? '' }}">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">No HP Orang Tua</th>
                                    <th scope="col">Alamat Orang Tua</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dormitizen)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dormitizen->nim }}</td>
                                        <td>{{ $dormitizen->nama }}</td>
                                        <td>{{ $dormitizen->prodi }}</td>
                                        <td>{{ $dormitizen->agama }}</td>
                                        <td>{{ $dormitizen->no_hp }}</td>
                                        <td>{{ $dormitizen->no_hp_ortu }}</td>
                                        <td>{{ $dormitizen->alamat_ortu }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $data->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
</x-layout>
