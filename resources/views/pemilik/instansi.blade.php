@extends('pemilik._base')
@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush
@section('content')
    <div class="row justify-content-center mt-4 mb-4 ">
        <div class="col-lg-6">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="m-0">Perbarui Data Instansi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('pemilik/instansi/simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_instansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}">
                            @error('nama_instansi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}">
                            @error('nomor_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" value="{{ $pemilik->latitude ?? '' }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" value="{{ $pemilik->longitude ?? '' }}">
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div id="map" style="width: 100%; height:350px"></div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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

        if (latitude == '') {
            latitude = 0.510440;
        }
        if (longitude == '') {
            longitude = 101.438309;
        }

        var map = L.map('map').setView([latitude, longitude], 13);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker draggable
        var marker = L.marker([latitude, longitude], {
            draggable: true
        }).addTo(map);

        // Fungsi untuk memperbarui nilai latitude dan longitude
        function updateLatLng(lat, lng) {
            $('#latitude').val(lat.toFixed(6));
            $('#longitude').val(lng.toFixed(6));
        }

        // Perbarui input saat marker dipindahkan
        marker.on('dragend', function(e) {
            var latLng = e.target.getLatLng();
            updateLatLng(latLng.lat, latLng.lng);
        });

        // Set nilai awal latitude dan longitude
        var initialLatLng = marker.getLatLng();
        updateLatLng(initialLatLng.lat, initialLatLng.lng);

        // Perbarui posisi marker saat input latitude dan longitude diubah
        $('#latitude, #longitude').on('input', function() {
            var newLat = parseFloat($('#latitude').val());
            var newLng = parseFloat($('#longitude').val());
            if (!isNaN(newLat) && !isNaN(newLng)) {
                marker.setLatLng([newLat, newLng]);
                map.setView([newLat, newLng], map.getZoom());
            }
        });
    </script>
@endpush
