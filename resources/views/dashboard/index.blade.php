<x-layout>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Selamat Datang</h5>
                        </div>
                        <div class="card-body mt-0">
                            <h1>{{ auth()->user()->nama }}</h1>
                            <h3>Gedung {{ auth()->user()->gedung->nama }} - {{ auth()->user()->gedung->kode }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Total dormitizen</h5>
                        </div>
                        <div class="card-body mt-0">
                            <h2>{{ $totalDormitizen }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kamar kosong</h5>
                        </div>
                        <div class="card-body mt-0">
                            <h2>{{ $kamarKosong }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Request keluar-masuk</h5>
                </div>
                <div class="card-body mt-0">
                    @if (count($logs) == 0)
                        <h3>Tidak ada request</h3>
                    @else
                        <div class="table-responsive" style="height:300px">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th scope="col">Nama Dormitizen</th>
                                        <th scope="col">Kamar</th>
                                        <th scope="col">Aktivitas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr class="text-center">
                                            <td>{{ $log->Dormitizen->nama }}</td>
                                            <td>{{ $log->Dormitizen->Kamar->nomor }}</td>
                                            <td>
                                                @if ($log['aktivitas'] == 'masuk')
                                                    <span
                                                        class="border border-3 rounded border-primary p-1 text-primary">{{ $log['aktivitas'] }}</span>
                                                @else
                                                    <span
                                                        class="border border-3 rounded border-danger p-1 text-danger">{{ $log['aktivitas'] }}</span>
                                                @endif
                                            </td>
                                            <td class="col-4">
                                                <form
                                                    action="/dashboard/updateLog/{{ $log['log_keluar_masuk_id'] }}/diterima"
                                                    method="post" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Terima</button>
                                                </form>
                                                <form
                                                    action="/dashboard/updateLog/{{ $log['log_keluar_masuk_id'] }}/ditolak"
                                                    method="post" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-layout>
