<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->string('kode', 30);
            $table->string('dosis', 30);
            $table->string('indikasi', 30);
            $table->unsignedBigInteger('kategori');
            $table->foreign('kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->unsignedBigInteger('satuan');
            $table->foreign('satuan')->references('id')->on('satuans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obats');
    }
}
