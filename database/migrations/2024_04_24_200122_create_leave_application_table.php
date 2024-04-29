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
        Schema::create('leave_application', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->string('information');
            $table->string('applier_user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('leave_type_id');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_application');
    }
};
