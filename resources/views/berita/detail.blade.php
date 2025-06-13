<x-layout>
    <!-- MAIN -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $berita->judul }}</h1>
                    <p><strong>Kategori:</strong> {{ $berita->kategori }}</p>
                    <p><strong>Tanggal Dibuat:</strong> {{ $berita->created_at->format('d-m-Y') }}</p>
                    <p><strong>Detail:</strong> {{ $berita->isi }}</p>
                    <p><strong>Nama Helpdesk:</strong> {{ $berita->helpdesk->nama }}</p>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN -->
</x-layout>