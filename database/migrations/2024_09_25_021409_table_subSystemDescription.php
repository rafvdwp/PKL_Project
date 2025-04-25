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
        Schema::create('subSystemDescription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subSystem_id');
            $table->unsignedBigInteger('project_id');
            $table->string('Description_name', 2000);
            $table->string('Description_jumlah');
            $table->timestamps();

            $table->foreign('subSystem_id')->references('id')->on('subSystem')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subSystemDescription');
    }
};
