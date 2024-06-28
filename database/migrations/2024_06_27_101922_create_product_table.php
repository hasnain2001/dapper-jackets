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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('productimage')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('color');
            $table->string('categories');
            $table->string('size')->nullable();
            $table->string('title')->nullable();
            $table->longText('meta_tag')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
