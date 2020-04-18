<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master', function (Blueprint $table) {
            $table->string('status',255);
            $table->timestamps();
        });

        Schema::table('content', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('answer', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('type', function (Blueprint $table) {
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
        Schema::table('master',function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->dropTimestamps();
        });

        Schema::table('content',function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('answer',function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('type',function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
