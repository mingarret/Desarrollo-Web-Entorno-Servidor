<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumen');
            $table->text('cuerpo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}

