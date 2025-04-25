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
        Schema::create('managespecificationbulkmaterial', function (Blueprint $table) {
            $table->id();
            $table->string('Description_name', 2000);
            $table->string('material_type', 2000);
            $table->string('name');

            $table->foreign('name')->references('name')->on('managesubSystem')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managespecificationbulkmaterial');
    }
};
