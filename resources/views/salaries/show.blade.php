@extends('master')

@section('title', 'Detail Gaji')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Detail Gaji</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%" class="bg-light">ID Gaji</th>
                            <td>{{ $salary->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Karyawan</th>
                            <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Departemen</th>
                            <td>{{ $salary->employee->department->nama_departemen ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Jabatan</th>
                            <td>{{ $salary->employee->position->nama_jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Bulan</th>
                            <td>{{ $salary->bulan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h5 class="mb-0">Rincian Gaji</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td>Gaji Pokok</td>
                                    <td class="text-end">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Tunjangan</td>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Potongan</td>
                                    <td class="text-end text-danger">- Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-success">
                                    <th>Total Gaji Diterima</th>
                                    <th class="text-end">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Informasi Tambahan</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Dibuat Pada:</strong> {{ $salary->created_at->format('d-m-Y H:i:s') }}</p>
                            <p><strong>Diupdate Pada:</strong> {{ $salary->updated_at->format('d-m-Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="card-body text-center">
                            @php
                                $total = $salary->total_gaji;
                                $statusClass = $total >= 5000000 ? 'bg-success' : ($total >= 3000000 ? 'bg-warning' : 'bg-info');
                                $statusText = $total >= 5000000 ? 'Tinggi' : ($total >= 3000000 ? 'Sedang' : 'Rendah');
                            @endphp
                            <h1 class="display-4 {{ $statusClass }} text-white p-3 rounded">
                                {{ $statusText }}
                            </h1>
                            <p class="text-muted">Kategori berdasarkan total gaji</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data gaji ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('salaries.index') }}" class="btn btn-secondary float-end">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection