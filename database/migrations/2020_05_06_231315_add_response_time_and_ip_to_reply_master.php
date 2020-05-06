<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponseTimeAndIpToReplyMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reply_master', function (Blueprint $table) {
            $table->unsignedInteger('response_time')
                  ->nullable()
                  ->after('master_id');
            $table->string('client_ip', 32)
                  ->nullable()
                  ->after('master_id');
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
            $table->dropColumn(['response_time', 'client_ip']);
        });
    }
}
