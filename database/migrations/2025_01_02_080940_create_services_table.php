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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('services_picture')->nullable();
            $table->string('services_title');
            $table->string('services_status');
            $table->decimal('services_fee', 10, 2);
            $table->string('services_category');
            $table->longText('services_description');
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });

        Schema::create('service_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('services_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('service_ratings')->onDelete('cascade');
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
        Schema::dropIfExists('service_ratings');
        Schema::dropIfExists('services');
    }
};
