<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->unique()->constrained();
            $table->unsignedInteger('pages_count')->nullable();
            $table->string('language', 30)->default('Arabic');
            $table->string('publisher')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_details');
    }
};
