<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Pokreni migraciju.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['smestaj', 'stednja novca', 'studentski zivot']);
            $table->string('title');
            $table->text('image');
            $table->text('excerpt');
            $table->integer('read_time'); // u minutama
            $table->string('file_link'); // Čuvanje puta do fajla u storage-u
            $table->timestamps(); // created_at i updated_at
        });
    }

    /**
     * Povratak promena u bazi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
