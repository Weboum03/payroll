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
        Schema::create('deboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reason');
            $table->string('notice_period');
            $table->string('comment');
            $table->date('start_date');
            $table->date('final_employment_date');
            $table->date('final_working_date');
            $table->integer('report_to');
            $table->string('support_comment');
            $table->boolean('re_employable');
            $table->integer('remaining_pl_year');
            $table->integer('remaining_pl_leave');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deboards');
    }
};
