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
        Schema::create('post_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('material_id');

            $table->index('post_id','post_material_post_idx');
            $table->index('material_id','post_material_material_idx');

            $table->foreign('post_id','post_material_post_fk')->on('posts')->references('id');
            $table->foreign('material_id','post_material_material_fk')->on('materials')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_materials');
    }
};
