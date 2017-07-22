<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deaths', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('deaths');
            $table->string('news_title');
            $table->text('news_detail');
            $table->string('news_src');
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
        Schema::dropIfExists('deaths');
    }
}
