<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content', function (Blueprint $table) {
            $table->bigInteger('master_id')->change()->unsigned();
            $table->bigInteger('type_id')->change()->unsigned();
            $table->foreign('master_id')->references('id')->on('master');
            $table->foreign('type_id')->references('id')->on('type');
        });

        Schema::table('answer', function (Blueprint $table) {
            $table->bigInteger('content_id')->change()->unsigned();
            $table->foreign('content_id')->references('id')->on('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content',function (Blueprint $table) {
           $table->dropForeign(['master_id']);
           $table->dropForeign(['type_id']);
        });

        Schema::table('answer',function (Blueprint $table) {
            $table->dropForeign(['content_id']);
        });
    }
}
