<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reply_master', function (Blueprint $table) {
            $table->foreign('master_id')->references('id')->on('master');
        });

        Schema::table('reply_content', function (Blueprint $table) {
            $table->foreign('content_id')->references('id')->on('content');
            $table->foreign('reply_master_id')->references('id')->on('reply_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reply_master', function (Blueprint $table) {
            $table->dropForeign(['master_id']);
        });

        Schema::table('reply_content', function (Blueprint $table) {
            $table->dropForeign(['content_id']);
            $table->dropForeign(['reply_master_id']);
        });
    }
}
