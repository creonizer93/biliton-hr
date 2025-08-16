<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::table('insurances', function (Blueprint $table) {
            // Menambahkan kolom employee_id yang nullable
            // dan mengatur foreign key ke tabel employees
            if (Schema::hasColumn('insurances', 'employee_id')) {
                return; // Kolom sudah ada, tidak perlu menambahkannya lagi
            } else {

                $table->unsignedBigInteger('employee_id')->nullable()->after('id');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
