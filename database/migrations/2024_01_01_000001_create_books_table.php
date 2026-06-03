<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('author', 150);
            $table->string('category', 80);
            $table->unsignedInteger('price');
            $table->string('cover_color', 200);
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->unsignedInteger('sold')->default(0);
            $table->boolean('is_new')->default(false);
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('pages')->nullable();
            $table->string('language', 50)->default('Indonesia');
            $table->string('publisher', 100)->nullable();
            $table->year('year')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
            
            $table->index('category');
            $table->index('seller_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};