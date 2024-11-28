@extends('pemilik._base')
@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush
@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="mt-4 row">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ asset('img/personal_info.svg') }}" alt="" style="width: 80px">
                        <div class="ms-4">
                            <p class="m-0 text-muted">Selamat Datang</p>
                            <h5 class="m-0">{{ Auth::user()->nama }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    @if ($pemilik == null)
                        <div class="alert alert-warning" role="alert">
                            Anda belum mengisi data instansi. Harap lengkapi data terlebih dahulu
                        </div>
                    @endif
                    <div class="d-flex">
                        <p>Nama Instansi</p>
                        <p class="ms-auto text-muted">{{ $pemilik->nama_instansi ?? '-' }}</p>
                    </div>
                    <div class="d-flex">
                        <p>Alamat</p>
                        <p class="ms-auto text-muted">{{ $pemilik->alamat ?? '-' }}</p>
                    </div>
                    <div class="d-flex">
                        <p>Nomor HP</p>
                        <p class="ms-auto text-muted">{{ $pemilik->nomor_hp ?? '-' }}</p>
                    </div>
                    <div class="d-flex">
                        <p>Deskripsi</p>
                        <p class="ms-auto text-muted">{{ $pemilik->deskripsi ?? '-' }}</p>
                    </div>
                    <div class="d-flex">
                        <p>Latitude</p>
                        <p class="ms-auto text-muted">{{ $pemilik->latitude ?? '-' }}</p>
                    </div>
                    <div class="d-flex">
                        <p>Longitude</p>
                        <p class="ms-auto text-muted">{{ $pemilik->longitude ?? '-' }}</p>
                    </div>
                    <a href="{{ url('pemilik/instansi') }}" class="btn btn-primary">Perbarui Data</a>
                </div>
            </div>
            @if ($pemilik != null && !empty($pemilik->latitude) && !empty($pemilik->longitude))
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-0">
                        <div id="map" style="height: 200px"></div>
                    </div>
                </div>
            @endif

        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm ">
                <div class="card-header bg-white">
                    <h5 class="m-0">List Ambulance</h5>
                </div>
                <div class="card-body">
                    @if ($pemilik == null)
                        <div class="alert alert-warning" role="alert">
                            Harap lengkapi data instansi terlebih dahulu
                        </div>
                    @else
                        <a href="{{ url('pemilik/ambulance/tambah') }}" class="btn btn-primary">Tambah Ambulance</a>
                        @if (isset($ambulance) && count($ambulance) == 0)
                            <p class="m-0 mt-4 text-muted">Tidak ada data ambulance</p>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var latitude = @json($pemilik->latitude ?? '');
        var longitude = @json($pemilik->longitude ?? '');

        if (latitude != '' && longitude != '') {
            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            var marker = L.marker([latitude, longitude]).addTo(map);

            marker.on('dragend', function(e) {
                var latLng = e.target.getLatLng();
            });

        }
    </script>
@endpush
