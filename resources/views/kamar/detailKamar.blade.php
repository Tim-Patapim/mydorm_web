<x-layout>
    <!-- MAIN -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Tabel Data -->
                    <div class="container mt-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $fromPelanggaran ? '' : 'active' }}" id="home-tab"
                                    data-bs-toggle="tab" href="#dormitizen" role="tab" aria-controls="dormitizen"
                                    aria-selected="true">Detail Penghuni</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Log Keluar Masuk</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $fromPelanggaran ? 'active' : '' }}" id="contact-tab"
                                    data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                    aria-selected="false">Pelanggaran</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade {{ $fromPelanggaran ? '' : 'active show' }}" id="dormitizen"
                                role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama Penghuni</th>
                                                <th>Program Studi</th>
                                                <th>Agama</th>
                                                <th>No HP Penghuni</th>
                                                <th>No HP Orang Tua</th>
                                                <th>Alamat Orang Tua</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dormitizens as $dormitizen)
                                                <tr>
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
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th scope="col">Nama Dormitizen</th>
                                                <th scope="col">Nama Penerima</th>
                                                <th scope="col">Kamar</th>
                                                <th scope="col">Waktu</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aktivitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logsData as $logs)
                                                @foreach ($logs as $log)
                                                    <tr class="text-center">
                                                        <td>{{ $log->dormitizen->nama }}</td>
                                                        <td>{{ $log->helpdesk_id ? $log->helpdesk->nama : $log->seniorResident->dormitizen->nama }}
                                                        </td>
                                                        <td>{{ $log->dormitizen->kamar->nomor }}</td>
                                                        <td>{{ $log->waktu }}</td>
                                                        <td>
                                                            @if ($log->status == 'diterima')
                                                                <span
                                                                    class="text-success border border-3 rounded border-success p-1">{{ $log['status'] }}</span>
                                                            @elseif ($log->status == 'pending')
                                                                <span
                                                                    class="text-warning border border-3 rounded border-warning p-1">{{ $log['status'] }}</span>
                                                            @else
                                                                <span
                                                                    class="text-danger border border-3 rounded border-danger p-1">{{ $log['status'] }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($log->aktivitas == 'masuk')
                                                                <span
                                                                    class="border border-3 rounded border-primary p-1 text-primary">{{ $log['aktivitas'] }}</span>
                                                            @else
                                                                <span
                                                                    class="border border-3 rounded border-danger p-1 text-danger">{{ $log['aktivitas'] }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $fromPelanggaran ? 'active show' : '' }}" id="contact"
                                role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mb-4"></div>
                                @for ($i = 0; $i < count($dormitizens); $i++)
                                    <h2 class="mb-4">{{ $dormitizens[$i]->nama }}</h2>
                                    @if (count($pelanggaransData[$i]) == 0)
                                        <div class="alert alert-warning" role="alert">
                                            Tidak ada pelanggaran
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Kategori</th>
                                                        <th>Waktu</th>
                                                        <th>Gambar</th>
                                                        <th>Senior Resident</th>
                                                        <th>Dormitizen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pelanggaransData[$i] as $pelanggaran)
                                                        <tr>
                                                            <td>{{ $pelanggaran->kategori }}</td>
                                                            <td>{{ $pelanggaran->waktu }}</td>
                                                            <td>
                                                                <img src="{{ asset('images/' . $pelanggaran->gambar) }}"
                                                                    alt="Bukti Pelanggaran" width="100"
                                                                    height="100" style="object-fit: cover;">
                                                            </td>
                                                            <td>{{ $pelanggaran->seniorResident->dormitizen->nama ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $pelanggaran->dormitizen->nama ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN -->
</x-layout>
