<x-layout>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar dan Dropdown -->
    <div class="row mb-4 justify-content-end">
        <div class="col-md-1 mb-3 text-end">
            <a href="{{ route('berita.create') }}">
                <button class="btn btn-danger">+</button>
            </a>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Cari disini">
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option selected disabled>Urutkan</option>
                <option value="1">Hari ini</option>
                <option value="2">Terlama</option>
            </select>
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
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Berita</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">Nama Helpdesk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- $iteration = 1; -->
                                @foreach ($beritas as $berita)
                                    <tr>
                                        <td>{{ $loop->iteration + ($beritas->currentPage() - 1) * $beritas->perPage() }}
                                        </td> <!-- Buat looping nomor urut -->
                                        <td>{{ $berita->judul }}</td>
                                        <td>{{ $berita->kategori }}</td>
                                        <td>{{ $berita->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $berita->helpdesk->nama }}</td>
                                        <td>
                                            <a href="{{ route('berita.show', $berita) }}"
                                                class="btn btn-info">Detail</a>
                                            <a href="{{ route('berita.edit', $berita) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('berita.destroy', $berita) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
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
    {{ $beritas->links('pagination::bootstrap-5') }}
</x-layout>
