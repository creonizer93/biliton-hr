<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('bpjs_health_number', 50)->nullable();
            $table->date('bpjs_health_join_date')->nullable();
            $table->string('bpjs_tk_number', 50)->nullable();
            $table->date('bpjs_tk_join_date')->nullable();
            $table->timestamps();
        });

        // Hapus kolom terkait di tabel employees
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'bpjs_health_number',
                'bpjs_health_join_date',
                'bpjs_tk_number',
                'bpjs_tk_join_date',
            ]);
        });
    }

    public function down(): void
    {
        // Kembalikan kolom ke tabel employees jika rollback
        Schema::table('employees', function (Blueprint $table) {
            $table->string('bpjs_health_number', 50)->nullable();
            $table->date('bpjs_health_join_date')->nullable();
            $table->string('bpjs_tk_number', 50)->nullable();
            $table->date('bpjs_tk_join_date')->nullable();
        });

        Schema::dropIfExists('insurances');
    }
};
