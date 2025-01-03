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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('trade_picture')->nullable();
            $table->string('trade_title');
            $table->string('trade_category');
            $table->longText('trade_description');
            $table->string('trade_status')->default('available');
            $table->string('trade_type');
            $table->decimal('trade_value', 8, 2)->nullable();
            $table->longText('trade_conditions')->nullable();
            $table->date('trade_duration')->nullable();
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });

        Schema::create('trade_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trades_id')->constrained('trades')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('trade_ratings')->onDelete('cascade');
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
        Schema::dropIfExists('trade_ratings');
        Schema::dropIfExists('trades');
    }
};
