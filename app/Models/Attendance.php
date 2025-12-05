<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'attendance'; // ← tambahkan ini karena nama tabel singular

    protected $fillable = [
        'karyawan_id', 
        'tanggal', 
        'waktu_masuk', 
        'waktu_keluar', 
        'status_absensi'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}