<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnInReviewTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_teachers', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->renameColumn('voting_helpful','number_of_likes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_teachers', function (Blueprint $table) {
            $table->date('date');
            $table->renameColumn('number_of_likes','voting_helpful');
        });
    }
}
