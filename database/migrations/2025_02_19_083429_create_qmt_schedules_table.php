<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qmt_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchise_id')->constrained('franchises')->onDelete('cascade');
            $table->integer('year');
            $table->date('q1')->nullable();
            $table->date('q2')->nullable();
            $table->date('q3')->nullable();
            $table->date('q4')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qmt_schedules');
    }
};
