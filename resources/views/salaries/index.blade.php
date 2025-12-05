@extends('master')

@section('title', 'Gaji')

@section('content')
<div class="container mt-4">
    <h2>Data Gaji Karyawan</h2>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Data Gaji
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
            <form action="{{ route('salaries.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="bulan" class="form-label">Bulan</label>
                    <input type="month" class="form-control" id="bulan" name="bulan" 
                           value="{{ request('bulan') }}">
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
                    <label for="min_gaji" class="form-label">Min. Gaji</label>
                    <input type="number" class="form-control" id="min_gaji" name="min_gaji" 
                           value="{{ request('min_gaji') }}" placeholder="Rp" min="0">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-info me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('salaries.index') }}" class="btn btn-secondary">
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
                <th>Bulan</th>
                <th>Karyawan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
            <tr>
                <td>{{ $salary->id }}</td>
                <td>{{ $salary->bulan }}</td>
                <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                <td><strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong></td>
                <td>
                    <a href="{{ route('salaries.show', $salary->id) }}" 
                       class="btn btn-sm btn-info btn-action">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('salaries.edit', $salary->id) }}" 
                       class="btn btn-sm btn-warning btn-action">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('salaries.destroy', $salary->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus data gaji ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data gaji</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Summary -->
    @if($salaries->count() > 0)
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Ringkasan</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <h6>Total Data</h6>
                    <h4>{{ $salaries->count() }}</h4>
                </div>
                <div class="col-md-3">
                    <h6>Total Gaji Pokok</h6>
                    <h4>Rp {{ number_format($salaries->sum('gaji_pokok'), 0, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6>Total Tunjangan</h6>
                    <h4>Rp {{ number_format($salaries->sum('tunjangan'), 0, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6>Total Diterima</h6>
                    <h4>Rp {{ number_format($salaries->sum('total_gaji'), 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <div class="d-flex justify-content-between mt-4">
        <div>Total: {{ $salaries->count() }} data gaji</div>
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Karyawan
            </a>
        </div>
    </div>
</div>
@endsection