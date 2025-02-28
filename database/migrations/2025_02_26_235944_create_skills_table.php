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
        Schema::create('skills', function (Blueprint $table) {
            $table->id(); //PK
            $table->unsignedBigInteger('curriculum_id'); //FK
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('cascade'); // llave foranea con curriculums
            $table->string('skill_name',50);
            $table->string('level',15);
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
