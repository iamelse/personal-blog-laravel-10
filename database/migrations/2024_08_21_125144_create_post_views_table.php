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
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->index('view_date');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->date('view_date');
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();
            $table->unique(['post_id', 'view_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
