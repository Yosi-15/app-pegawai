@extends('master')

@section('title', 'Tambah Departemen')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-building"></i> Tambah Departemen Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_departemen" class="form-label">Nama Departemen *</label>
                    <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror" 
                           id="nama_departemen" name="nama_departemen" 
                           value="{{ old('nama_departemen') }}" required maxlength="100">
                    @error('nama_departemen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection