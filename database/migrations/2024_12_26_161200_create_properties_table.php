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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('images')->nullable();
            $table->text('description');
            $table->string('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->text('ownership_proof')->nullable();
            $table->string('tags')->nullable();
            $table->integer('area')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('current_floor');
            $table->enum('type', ['Stan', 'Soba'])->nullable();
            $table->enum('property_type', ['Garsonjera', 'Jednosoban', 'Dvosoban', 'Trosoban', '4+ soba', 'Jednokrevetna', 'Dvokrevetna', 'Trokrevetna']);
            $table->enum('heating', ['Centralno', 'Struja', 'Gas', 'Nema'])->nullable();
            $table->decimal('rent_price', 10, 2)->nullable();
            $table->decimal('monthly_utilities', 10, 2)->nullable();
            $table->enum('status', ['Active', 'Inactive','Pending', 'Declined'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
