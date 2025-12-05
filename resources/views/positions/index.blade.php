@extends('master')

@section('title', 'Jabatan')

@section('content')
<div class="container mt-4">
    <h2>Jabatan</h2>
    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Jabatan
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th width="50">ID</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Jumlah Karyawan</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $pos)
            <tr>
                <td>{{ $pos->id }}</td>
                <td>{{ $pos->nama_jabatan }}</td>
                <td>Rp {{ number_format($pos->gaji_pokok, 0, ',', '.') }}</td>
                <td>{{ $pos->employees_count ?? 0 }}</td>
                <td>
                    <a href="{{ route('positions.show', $pos->id) }}" 
                       class="btn btn-sm btn-info btn-action">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('positions.edit', $pos->id) }}" 
                       class="btn btn-sm btn-warning btn-action">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('positions.destroy', $pos->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus jabatan {{ $pos->nama_jabatan }}?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data jabatan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between">
        <div>Total: {{ $positions->count() }} jabatan</div>
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Karyawan
            </a>
        </div>
    </div>
</div>
@endsection