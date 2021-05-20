<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('hid');
            $table->tinyInteger('period'); //1=Haftalık 2=Aylık 3=Senelik
            $table->integer('remoteId');
            $table->string('startTime', 255); //cronjob başlama bilgisi burada olacak.
            $table->tinyInteger('backupItems'); //Files + Database. Serial şekilde tutulabilir
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
        Schema::dropIfExists('schedule');
    }
}
