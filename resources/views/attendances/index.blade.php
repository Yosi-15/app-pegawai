@extends('master')

@section('title', 'Absensi')

@section('content')
<div class="container mt-4">
    <h2>Data Absensi</h2>
    <a href="{{ route('attendances.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Absensi
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filter</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('attendances.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" 
                           value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <label for="karyawan_id" class="form-label">Karyawan</label>
                    <select class="form-control" id="karyawan_id" name="karyawan_id">
                        <option value="">Semua Karyawan</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ request('karyawan_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status_absensi" class="form-label">Status</label>
                    <select class="form-control" id="status_absensi" name="status_absensi">
                        <option value="">Semua Status</option>
                        <option value="hadir" {{ request('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ request('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ request('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ request('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-info me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th width="50">ID</th>
                <th>Tanggal</th>
                <th>Karyawan</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $att)
            <tr>
                <td>{{ $att->id }}</td>
                <td>{{ \Carbon\Carbon::parse($att->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $att->employee->nama_lengkap ?? '-' }}</td>
                <td>{{ $att->waktu_masuk ? \Carbon\Carbon::parse($att->waktu_masuk)->format('H:i') : '-' }}</td>
                <td>{{ $att->waktu_keluar ? \Carbon\Carbon::parse($att->waktu_keluar)->format('H:i') : '-' }}</td>
                <td>
                    @php
                        $badgeClass = [
                            'hadir' => 'bg-success',
                            'izin' => 'bg-warning',
                            'sakit' => 'bg-info',
                            'alpha' => 'bg-danger'
                        ][$att->status_absensi] ?? 'bg-secondary';
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                        {{ ucfirst($att->status_absensi) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('attendances.show', $att->id) }}" 
                       class="btn btn-sm btn-info btn-action">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('attendances.edit', $att->id) }}" 
                       class="btn btn-sm btn-warning btn-action">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('attendances.destroy', $att->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus data absensi ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data absensi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between">
        <div>Total: {{ $attendances->count() }} absensi</div>
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Karyawan
            </a>
        </div>
    </div>
</div>
@endsection