<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('location');
            $table->string('franchisee_name');
            $table->string('contact_number');
            $table->string('variant');
            $table->date('franchise_date');
            $table->enum('status', ['active', 'for renewal', 'closed', 'pending'])->default('pending'); // Added status column
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchises');
    }
};
