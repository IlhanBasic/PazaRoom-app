<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('property_tags', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->string('tag');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_tags');
    }
};
