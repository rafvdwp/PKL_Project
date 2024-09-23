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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // Relasi ke Project
            $table->string('lan');
            $table->string('telephone');
            $table->string('paga');
            $table->string('acs');
            $table->string('hotline');
            $table->string('pids');
            $table->string('radio_system');
            $table->string('radio_dmr');
            $table->string('cctv');
            $table->string('catv');
            $table->timestamps();

            // Set foreign key ke project
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
