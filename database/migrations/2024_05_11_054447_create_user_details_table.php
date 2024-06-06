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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('gender', 10);
            $table->date('dob')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('alternate_phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('address_1', 255)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('state', 20)->nullable();
            $table->string('country', 20)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('as_local', 10)->nullable();
            $table->string('p_address', 255)->nullable();
            $table->string('p_address_1', 255)->nullable();
            $table->string('p_city', 20)->nullable();
            $table->string('p_state', 20)->nullable();
            $table->string('p_country', 20)->nullable();
            $table->string('p_postcode', 10)->nullable();
            $table->date('doj')->nullable();
            $table->date('prob_end_date')->nullable();
            $table->string('company', 20)->nullable();
            $table->string('location', 50)->nullable();
            $table->string('qualification', 50)->nullable();
            $table->string('experience', 50)->nullable();
            $table->string('immediate_manager', 50)->nullable();
            $table->string('immediate_manager_code', 50)->nullable();
            $table->string('leave_approving_auth', 50)->nullable();
            $table->string('leave_approving_code', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->string('job_role', 50)->nullable();
            $table->string('grade', 10)->nullable();
            $table->string('employment_type', 50)->nullable();
            $table->string('aadhar_number', 20)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('holiday_year', 20)->nullable();
            $table->string('work_pattern', 20)->nullable();
            $table->integer('earning_leave_entitlement')->default(0);
            $table->string('this_year', 20)->nullable();
            $table->string('next_year', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
