@extends('master')

@section('title', 'Departemen')

@section('content')
<div class="container mt-4">
    <h2>Departemen</h2>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Departemen
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
                <th>Nama Departemen</th>
                <th>Jumlah Karyawan</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $dept)
            <tr>
                <td>{{ $dept->id }}</td>
                <td>{{ $dept->nama_departemen }}</td>
                <td>{{ $dept->employees_count ?? 0 }}</td>
                <td>
                    <a href="{{ route('departments.show', $dept->id) }}" 
                       class="btn btn-sm btn-info btn-action">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('departments.edit', $dept->id) }}" 
                       class="btn btn-sm btn-warning btn-action">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('departments.destroy', $dept->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus departemen {{ $dept->nama_departemen }}?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data departemen</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between">
        <div>Total: {{ $departments->count() }} departemen</div>
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Karyawan
            </a>
        </div>
    </div>
</div>
@endsection