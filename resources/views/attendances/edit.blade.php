@extends('master')

@section('title', 'Edit Absensi')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Absensi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label">Karyawan *</label>
                    <select class="form-control @error('karyawan_id') is-invalid @enderror" 
                            id="karyawan_id" name="karyawan_id" required disabled>
                        <option value="{{ $attendance->karyawan_id }}" selected>
                            {{ $attendance->employee->nama_lengkap ?? 'Karyawan tidak ditemukan' }}
                        </option>
                    </select>
                    <input type="hidden" name="karyawan_id" value="{{ $attendance->karyawan_id }}">
                    @error('karyawan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal *</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                           id="tanggal" name="tanggal" 
                           value="{{ old('tanggal', $attendance->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                        <input type="time" class="form-control @error('waktu_masuk') is-invalid @enderror" 
                               id="waktu_masuk" name="waktu_masuk" 
                               value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}">
                        @error('waktu_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                        <input type="time" class="form-control @error('waktu_keluar') is-invalid @enderror" 
                               id="waktu_keluar" name="waktu_keluar" 
                               value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}">
                        @error('waktu_keluar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="status_absensi" class="form-label">Status Absensi *</label>
                    <select class="form-control @error('status_absensi') is-invalid @enderror" 
                            id="status_absensi" name="status_absensi" required>
                        <option value="">Pilih Status</option>
                        <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                    @error('status_absensi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection