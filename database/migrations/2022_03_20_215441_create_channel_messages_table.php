<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('channel_id')->unsigned();
            $table->integer('from_user_id')->unsigned();
            $table->foreign('channel_id')->references('id')->on('channels');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->string('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_messages');
    }
}
