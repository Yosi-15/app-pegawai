@extends('master')

@section('title', 'Detail Departemen')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-building"></i> Detail Departemen</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">ID Departemen</th>
                            <td>{{ $department->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Departemen</th>
                            <td>{{ $department->nama_departemen }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Dibuat Pada</th>
                            <td>{{ $department->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Diupdate Pada</th>
                            <td>{{ $department->updated_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0">Statistik</h6>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="display-4">{{ $department->employees_count ?? 0 }}</h1>
                            <p class="text-muted">Karyawan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Karyawan di Departemen Ini -->
            <div class="mt-4">
                <h5><i class="fas fa-users"></i> Karyawan di Departemen Ini</h5>
                @if(isset($department->employees) && $department->employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($department->employees as $employee)
                                    <tr>
                                        <td>{{ $employee->nama_lengkap }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $employee->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $employee->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> Tidak ada karyawan di departemen ini.
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus departemen ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary float-end">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection