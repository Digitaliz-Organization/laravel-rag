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
        Schema::create('chunks', function (Blueprint $table) {
            $table->id();
            $table->string('guid');
            $table->string('sort_order')->default(1);
            $table->longText('content')->nullable();
            $table->longText('summary')->nullable();
            $table->json('embedding_1536')->nullable();
            $table->json('embedding_2048')->nullable();
            $table->json('embedding_3072')->nullable();
            $table->json('embedding_1024')->nullable();
            $table->json('embedding_4096')->nullable();
            $table->integer('section_number')->nullable();
            $table->longText('original_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chunks');
    }
};
