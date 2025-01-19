<?php

use App\Models\User;
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
        Schema::create('sale_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->default(1);
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->string('condition');
            $table->json('photos');
            $table->string('brand')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_posts');
    }
};
