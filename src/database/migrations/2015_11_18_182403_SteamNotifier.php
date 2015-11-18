<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SteamNotifier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steam_log', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('steam_id', 50);
            $table->integer('in_game');
            $table->integer('game_id')->nullable();
            $table->string('game_name', 255)->nullable();
            $table->integer('updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steam_log');
    }
}
