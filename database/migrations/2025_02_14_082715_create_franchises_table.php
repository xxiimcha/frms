<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code')->unique();
            $table->string('branch');
            $table->string('region'); // Branch area
            $table->string('location'); // Salon address
            $table->string('franchisee_name');
            $table->string('email_address')->unique();
            $table->date('birthday');
            $table->string('home_address');
            $table->string('contact_number');
            $table->foreignId('variant_id')->constrained('franchise_variants')->onDelete('cascade'); // References franchise_variants table
            $table->date('franchise_date');
            $table->date('end_of_contract');
            $table->enum('status', ['active', 'for renewal', 'closed', 'pending'])->default('pending'); // Keeping status column
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchises');
    }
};
