<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-3">
                        @foreach (['4', '3', '2', '1'] as $lantai)
                            <div class="mb-4">
                                <h4>Lantai {{ $lantai }}</h4>
                                <div class="row">
                                    @foreach ($kamars as $kamar)
                                        @if (substr($kamar->nomor, 0, 1) == $lantai && $kamar->gedung_id == auth()->user()->gedung->gedung_id)
                                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-3 col-3">
                                                <a href="/kamar/{{ $kamar->kamar_id }}">
                                                    <div
                                                        class="room {{ $kamar->status == 'terbuka' ? 'available' : 'occupied' }}">
                                                        {{ $kamar->nomor }}
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<style>
    .room {
        height: 80px;
        width: 80px;
        justify-content: center;
        display: flex;
        align-items: center;
        color: white;
        border-radius: 10px;
        margin: 10px;
    }

    .available {
        background-color: grey;
        /* Grey */
    }

    .occupied {
        background-color: #994F56;
        /* Red */
    }
</style>
