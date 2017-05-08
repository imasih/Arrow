<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer("link");
            $table->integer("photo");
            $table->integer("voice");
            $table->integer("username");
            $table->integer("text");
            $table->integer("document");
            $table->integer("sticker");
            $table->integer("audio");
            $table->integer("video");
            $table->integer("contact");
            $table->increments("id");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
