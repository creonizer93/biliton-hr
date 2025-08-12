<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('ktp_number', 20)->unique();
            $table->string('employee_code', 50)->unique();
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address_ktp')->nullable();
            $table->text('address_domicile')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();

            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained()->cascadeOnDelete();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete();

            $table->enum('status_employee', ['active', 'resigned', 'probation', 'contract'])->default('active');
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('bpjs_health_number', 50)->nullable();
            $table->date('bpjs_health_join_date')->nullable();
            $table->string('bpjs_tk_number', 50)->nullable();
            $table->date('bpjs_tk_join_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
