<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('mediables', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('media_id')->unsigned();
            $table->morphs('mediable');
            $table->string('album')->nullable();
            $table->text('tags')->nullable();
            $table->text('data')->nullable();
            $table->timestamps();

            $table->foreign('media_id')
                ->references('id')
                ->on('media')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('mediables');

        Schema::enableForeignKeyConstraints();
    }
}
