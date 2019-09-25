<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_center', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('center_id');
            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');
            // $table->foreign('center_id')
            // ->references('id')->on('centers')
            // ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('user_center');
    }
}
