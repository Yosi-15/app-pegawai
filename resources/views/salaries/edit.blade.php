@extends('master')

@section('title', 'Edit Data Gaji')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Data Gaji</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label">Karyawan *</label>
                    <select class="form-control @error('karyawan_id') is-invalid @enderror" 
                            id="karyawan_id" name="karyawan_id" required disabled>
                        <option value="{{ $salary->karyawan_id }}" selected>
                            {{ $salary->employee->nama_lengkap ?? 'Karyawan tidak ditemukan' }}
                        </option>
                    </select>
                    <input type="hidden" name="karyawan_id" value="{{ $salary->karyawan_id }}">
                    @error('karyawan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="bulan" class="form-label">Bulan *</label>
                    <input type="month" class="form-control @error('bulan') is-invalid @enderror" 
                           id="bulan" name="bulan" 
                           value="{{ old('bulan', $salary->bulan) }}" required>
                    @error('bulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok (Rp) *</label>
                        <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                               id="gaji_pokok" name="gaji_pokok" 
                               value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" 
                               required min="0" step="1000">
                        @error('gaji_pokok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="tunjangan" class="form-label">Tunjangan (Rp)</label>
                        <input type="number" class="form-control @error('tunjangan') is-invalid @enderror" 
                               id="tunjangan" name="tunjangan" 
                               value="{{ old('tunjangan', $salary->tunjangan) }}" 
                               min="0" step="1000">
                        @error('tunjangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="potongan" class="form-label">Potongan (Rp)</label>
                        <input type="number" class="form-control @error('potongan') is-invalid @enderror" 
                               id="potongan" name="potongan" 
                               value="{{ old('potongan', $salary->potongan) }}" 
                               min="0" step="1000">
                        @error('potongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="total_gaji" class="form-label">Total Gaji (Rp) *</label>
                    <input type="number" class="form-control @error('total_gaji') is-invalid @enderror" 
                           id="total_gaji" name="total_gaji" 
                           value="{{ old('total_gaji', $salary->total_gaji) }}" 
                           required min="0" step="1000">
                    @error('total_gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('salaries.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto calculate total gaji for edit form
document.addEventListener('DOMContentLoaded', function() {
    const gajiPokok = document.getElementById('gaji_pokok');
    const tunjangan = document.getElementById('tunjangan');
    const potongan = document.getElementById('potongan');
    const totalGaji = document.getElementById('total_gaji');
    
    function calculateTotal() {
        const gaji = parseFloat(gajiPokok.value) || 0;
        const tunj = parseFloat(tunjangan.value) || 0;
        const pot = parseFloat(potongan.value) || 0;
        const total = gaji + tunj - pot;
        totalGaji.value = total >= 0 ? total : 0;
    }
    
    gajiPokok.addEventListener('input', calculateTotal);
    tunjangan.addEventListener('input', calculateTotal);
    potongan.addEventListener('input', calculateTotal);
});
</script>
@endsection