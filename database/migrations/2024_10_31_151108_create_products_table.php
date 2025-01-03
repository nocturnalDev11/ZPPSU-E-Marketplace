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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('prod_picture')->nullable();
            $table->string('prod_name');
            $table->decimal('prod_price', 10, 2);
            $table->string('prod_status');
            $table->string('prod_category');
            $table->string('prod_condition');
            $table->longText('prod_description');
            $table->integer('prod_quantity')->default(0);
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('ratings')->onDelete('cascade');
            $table->longText('rating_text')->nullable();
            $table->decimal('rating_value', 2, 1)->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
