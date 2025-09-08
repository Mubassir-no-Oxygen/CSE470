<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('location')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('availabilities'); }
};
