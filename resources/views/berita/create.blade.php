<x-layout>
    <!-- MAIN -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Tambah Berita</h1>
                    <form action="{{ route('berita.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama Berita</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="Fasilitas asrama">Fasilitas asrama</option>
                                <option value="Kegiatan/Event asrama">Kegiatan/Event asrama</option>
                                <option value="Tata tertib">Tata tertib</option>
                                <option value="Info penting dari ditmawa">Info penting dari ditmawa</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Detail</label>
                            <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="helpdesk_id" class="form-label">Nama Helpdesk</label>
                            <input type="text" class="form-control" value="{{auth()->user()->nama}}" disabled>
                            <input type="text" class="form-control" name="helpdesk_id" value="{{auth()->user()->helpdesk_id}}" hidden>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN -->
</x-layout>