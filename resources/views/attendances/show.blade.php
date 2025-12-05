@extends('master')

@section('title', 'Detail Absensi')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Detail Absensi</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%" class="bg-light">ID Absensi</th>
                            <td>{{ $attendance->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Karyawan</th>
                            <td>{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Departemen</th>
                            <td>{{ $attendance->employee->department->nama_departemen ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%" class="bg-light">Waktu Masuk</th>
                            <td>{{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Waktu Keluar</th>
                            <td>{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                @php
                                    $badgeClass = [
                                        'hadir' => 'bg-success',
                                        'izin' => 'bg-warning',
                                        'sakit' => 'bg-info',
                                        'alpha' => 'bg-danger'
                                    ][$attendance->status_absensi] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($attendance->status_absensi) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Durasi Kerja</th>
                            <td>
                                @if($attendance->waktu_masuk && $attendance->waktu_keluar)
                                    @php
                                        $start = \Carbon\Carbon::parse($attendance->waktu_masuk);
                                        $end = \Carbon\Carbon::parse($attendance->waktu_keluar);
                                        $diff = $start->diff($end);
                                    @endphp
                                    {{ $diff->h }} jam {{ $diff->i }} menit
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <h5><i class="fas fa-info-circle"></i> Catatan</h5>
                @if($attendance->status_absensi == 'hadir')
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Karyawan hadir pada tanggal ini.
                    </div>
                @elseif($attendance->status_absensi == 'izin')
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle"></i> Karyawan izin tidak masuk.
                    </div>
                @elseif($attendance->status_absensi == 'sakit')
                    <div class="alert alert-info">
                        <i class="fas fa-heartbeat"></i> Karyawan sakit.
                    </div>
                @elseif($attendance->status_absensi == 'alpha')
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle"></i> Karyawan tidak hadir tanpa keterangan.
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data absensi ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('attendances.index') }}" class="btn btn-secondary float-end">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection