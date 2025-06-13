<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('paket.update', $paket->paket_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-container mb-3">
                            @if ($paket)
                                <!-- Menampilkan Nama Dormitizen dan Nomor Kamar -->
                                <div class="kamar-container mb-3">
                                    <label class="form-label">Nomor Kamar</label>
                                    <div id="dormitizen-kamar" class="mt-1">
                                        <input type="text" class="form-control"
                                            value="{{ $paket->dormitizen->kamar->nomor }}" readonly>
                                    </div>
                                </div>
                                <div class="nama-container mb-3">
                                    <label for="dormitizen" class="form-label">Nama Dormitizen</label>
                                    <div id="dormitizen-nama" class="mt-1">
                                        <input type="text" class="form-control"
                                            value="{{ $paket->dormitizen->nama }}" readonly>
                                    </div>
                                </div>
                            @endif

                            <!-- Penyerah Paket -->
                            <div class="pjPenerima-container mb-3">
                                <label for="pjPenyerah" class="form-label">Penyerah Paket</label>
                                <input type="text" name="penyerahan_paket" class="form-control"
                                    value="{{ auth()->user()->helpdesk_id }}" hidden>
                                <input type="text" name="pjPenyerah" class="form-control"
                                    value="{{ auth()->user()->nama }}" readonly>
                            </div>

                            <!-- Waktu Diambil -->
                            <div class="waktu-container mb-3">
                                <label for="waktu_diambil" class="form-label">Waktu Diambil</label>
                                <input type="datetime-local" class="form-control" name="waktu_diambil" required>
                            </div>

                            <!-- Status Pengambilan -->
                            <div class="status-container mb-3">
                                <label for="status_pengambilan" class="form-label">Status Pengambilan</label>
                                <select name="status_pengambilan" class="form-select" required>
                                    <option value="belum">Belum</option>
                                    <option value="sudah">Sudah</option>
                                </select>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="btn-simpan">
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
