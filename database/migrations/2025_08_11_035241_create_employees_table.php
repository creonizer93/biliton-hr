<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('ktp_number')->nullable()->unique();
            $table->string('employee_code')->nullable()->unique();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address_ktp')->nullable();
            $table->text('address_domicile')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('division')->nullable();
            $table->foreignId('cluster_id')->nullable()->constrained('clusters')->nullOnDelete();
            $table->string('position')->nullable();
            $table->enum('status_employee', ['active', 'resign'])->default('active');
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bpjs_health_number')->nullable();
            $table->date('bpjs_health_join_date')->nullable();
            $table->string('bpjs_tk_number')->nullable();
            $table->date('bpjs_tk_join_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
