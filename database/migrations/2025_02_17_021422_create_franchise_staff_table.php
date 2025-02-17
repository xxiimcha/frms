<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('franchise_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchise_id')->constrained('franchises')->onDelete('cascade');
            $table->string('staff_name');
            $table->string('staff_designation');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchise_staff');
    }
};
