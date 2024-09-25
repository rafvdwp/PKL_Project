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
        Schema::create('lan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lan_id');
            $table->string('router');
            $table->string('switch');
            $table->string('hub');
            $table->string('bridge');
            $table->string('repeater');
            $table->string('kabel_utp');
            $table->string('kabel_optik');
            $table->timestamps();

            $table->foreign('lan_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lan');
    }
};
