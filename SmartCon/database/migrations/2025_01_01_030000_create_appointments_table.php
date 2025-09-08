<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('availability_id')->nullable()->constrained('availabilities')->nullOnDelete();
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('status')->default('pending');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('appointments'); }
};
