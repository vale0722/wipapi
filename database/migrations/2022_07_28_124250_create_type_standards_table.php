<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('type_standards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            $table->foreign('subject_id')
                ->on('subjects')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_standards');
    }
};
