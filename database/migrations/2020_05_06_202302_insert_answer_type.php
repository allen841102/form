<?php

use App\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAnswerType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Type::updateOrCreate(
            ['name' => '單選'],
            ['name' => '單選', 'desc' => '單選題']
        );
        Type::updateOrCreate(
            ['name' => '多選'],
            ['name' => '多選', 'desc' => '多選題']
        );
        Type::updateOrCreate(
            ['name' => '簡答'],
            ['name' => '簡答', 'desc' => '簡答題']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
