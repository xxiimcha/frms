<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Ensure the franchises table exists first
        if (!Schema::hasTable('franchises')) {
            throw new \Exception("Table 'franchises' does not exist. Run the franchises migration first.");
        }

        Schema::create('franchise_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchise_id')->constrained('franchises')->onDelete('cascade');
            $table->string('letter_of_intent')->nullable();
            $table->string('resume')->nullable();
            $table->string('market_study')->nullable();
            $table->string('vicinity_map')->nullable();
            $table->string('presentation_fee')->nullable();
            $table->string('site_inspection')->nullable();
            $table->string('battery_test')->nullable();
            $table->json('valid_ids')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchise_requirements');
    }
};
