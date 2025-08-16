<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // drop foreign key constraint dulu
            $table->dropForeign(['insurance_id']);

            // baru drop kolom
            $table->dropColumn('insurance_id');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id')->nullable()->after('bank_name');
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
        });
    }
};
