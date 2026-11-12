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
        Schema::create('tool_return_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_return_id')->constrained();
            $table->foreignId('borrowing_detail_id')->constrained();
            $table->unique(['tool_return_id', 'borrowing_detail_id']);
            $table->unsignedInteger('quantity_returned');
            $table->enum('condition', ['good', 'damaged', 'maintenance']);
            $table->unsignedInteger('fine_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_return_details');
    }
};
