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
        Schema::create('specification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subSystem_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('subSystemDescription_id')->nullable();
            $table->string('specification', 2000);
            $table->string('part_number');
            $table->string('unit');
            $table->string('qty');
            $table->string('unit_price')->nullable();
            $table->timestamps();

            $table->foreign('subSystem_id')->references('id')->on('subSystem')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('subSystemDescription_id')->references('id')->on('subSystemDescription')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specification');
    }
};
