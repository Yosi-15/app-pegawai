<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambah kolom departemen_id dan jabatan_id jika belum ada
            if (!Schema::hasColumn('employees', 'departemen_id')) {
                $table->unsignedBigInteger('departemen_id')->after('tanggal_masuk');
            }
            if (!Schema::hasColumn('employees', 'jabatan_id')) {
                $table->unsignedBigInteger('jabatan_id')->after('departemen_id');
            }

            // Tambah foreign key
            $table->foreign('departemen_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            $table->foreign('jabatan_id')
                  ->references('id')
                  ->on('positions')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['departemen_id']);
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};