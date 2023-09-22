<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourdisposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jourdispos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_annonce');
            $table->string('jour');
            $table->string('de');
            $table->string('a');
            $table->date('reserved_for');
            $table->string('etat');
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
        Schema::dropIfExists('jourdispos');
    }
}
