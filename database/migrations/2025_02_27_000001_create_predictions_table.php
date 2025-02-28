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
        Schema::create('predictions', function (Blueprint $table) {

            $table->id();   //PK
            $table->unsignedBigInteger('curriculum_id'); // FK
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('cascade');// llave foranea con curriculums
            $table->string('predictions',100);

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
