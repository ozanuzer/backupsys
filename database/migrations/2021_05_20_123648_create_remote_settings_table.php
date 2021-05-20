<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemoteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remote_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('remotelogin', 150);
            $table->string('remotepass', 150);
            $table->text('remotepath');
            $table->string('remoteprt', 10);
            $table->tinyInteger('remotetype');
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
        Schema::dropIfExists('remote_settings');
    }
}
