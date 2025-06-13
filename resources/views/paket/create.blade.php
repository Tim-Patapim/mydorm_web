<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('paket.searchDormitizen') }}" method="GET" class="mb-3">
                        @csrf
                        <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                        @if (session('dormitizens'))
                            <div class="input-group">
                                <input type="number" name="nomor_kamar" class="form-control"
                                    placeholder="{{ session('nomorKamar') }}" required>
                                <button type="submit" class="btn btn-secondary">Cari Kamar</button>
                            </div>
                        @else
                            <div class="input-group">
                                <input type="number" name="nomor_kamar" class="form-control"
                                    placeholder="Masukkan nomor kamar" required>
                                <button type="submit" class="btn btn-secondary">Cari Kamar</button>
                            </div>
                        @endif
                    </form>

                    <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-container mb-3">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @elseif(session('dormitizens'))
                                <div class="nama-container mb-3">
                                    <label for="dormitizen" class="form-label">Nama Dormitizen</label>
                                    <div id="dormitizen-list" class="mt-3">
                                        @if (count(session('dormitizens')) > 0)
                                            <select id="dormitizen-select" name="dormitizen_id" class="form-select"
                                                required>
                                                <option value="" disabled selected>Pilih Dormitizen</option>
                                                @foreach (session('dormitizens') as $dormitizen)
                                                    <option value="{{ $dormitizen['dormitizen_id'] }}">
                                                        {{ $dormitizen['nama'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p class="text-danger">Tidak ada Dormitizen ditemukan.</p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="pjPenerima-container mb-3">
                                <label for="pjPenyerah" class="form-label">Penerima Paket</label>
                                <input type="text" name="penerima_paket" class="form-control"
                                    value="{{ auth()->user()->helpdesk_id }}" hidden>
                                <input type="text" name="pjPenyerah" class="form-control"
                                    value="{{ auth()->user()->nama }}" readonly>
                            </div>


                            <div class="waktu-container mb-3">
                                <label for="waktu_tiba" class="form-label">Waktu Tiba</label>
                                <input type="datetime-local" class="form-control" name="waktu_tiba" required>
                            </div>

                            <div class="mb-3">
                                <label for="">Upload Gambar</label>
                                <input type="file" name="gambar" class="form-control" required>
                            </div>


                            <div class="btn-simpan mt-4">
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
