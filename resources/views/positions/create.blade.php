@extends('master')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-briefcase"></i> Tambah Jabatan Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('positions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan *</label>
                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                           id="nama_jabatan" name="nama_jabatan" 
                           value="{{ old('nama_jabatan') }}" required maxlength="100">
                    @error('nama_jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="gaji_pokok" class="form-label">Gaji Pokok (Rp) *</label>
                    <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                           id="gaji_pokok" name="gaji_pokok" 
                           value="{{ old('gaji_pokok') }}" required min="0" step="1000">
                    @error('gaji_pokok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection