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
                    <h5 class="m-0">Form Data Ambulance</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('pemilik/ambulance/simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ request()->segment(4) ?? '' }}">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') == 'Tersedia' ? 'selected' : '' is-invalid @enderror" id="status">
                                <option value="">-Pilih-</option>
                                <option {{ old('status') == 'Tersedia' ? 'selected' : '' }} value="Tersedia">Tersedia</option>
                                <option {{ old('status') == 'Tidak Tersedia' ? 'selected' : '' }} value="Tidak Tersedia">Tidak Tersedia</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ old('foto') }}">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

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
@endpush
