<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApotiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->string('direktur', 30);
            $table->string('telp', 30);
            $table->string('email', 30);
            $table->string('rekening', 30);
            $table->string('alamat', 150);
            $table->decimal('balance', 9, 2)->nullable();
            $table->text('logo')->nullable();
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
        Schema::dropIfExists('apotiks');
    }
}
