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
            $table->string('birth_place', 100);
            $table->date('birth_date');
            $table->text('address_ktp');
            $table->text('address_domicile');
            $table->string('phone_number', 20);
            $table->string('email', 100);

            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained()->cascadeOnDelete();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete();

            $table->enum('status_employee', ['active', 'inactive', 'freelance', 'resigned'])
                ->default('active');
            $table->date('join_date');
            $table->date('resign_date')->nullable(); // ✅ sekarang nullable
            $table->string('bank_account_number', 50);
            $table->string('bank_name', 100);
            $table->foreignId('insurance_id')->nullable()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
