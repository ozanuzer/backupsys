<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('locked');
            $table->integer('hid');
            $table->integer('schid');
            $table->tinyInteger('backupItems');
            $table->string('remoteip', 150);
            $table->string('remotelogin', 150);
            $table->string('remotepass', 150);
            $table->text('remotepath');
            $table->string('remoteport', 10);
            $table->string('remotetype', 15);
            $table->text('path');
            $table->text('dbpath');
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
        Schema::dropIfExists('queue');
    }
}
