<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CheckMail extends Migration
{
    public function up()
    {
        Schema::create('checkMail', function (Blueprint $table) {
            $table->id();
            $table->date('dateMail');
            $table->boolean('checkSend');
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
        Schema::dropIfExists('checkMail');
    }
}
