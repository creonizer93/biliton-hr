<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('bpjs_health_number', 13)->unique();
            $table->date('bpjs_health_join_date');
            $table->string('bpjs_tk_number', 11)->unique();
            $table->date('bpjs_tk_join_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Kembalikan kolom ke tabel employees jika rollbac

        Schema::dropIfExists('insurances');
    }
};
