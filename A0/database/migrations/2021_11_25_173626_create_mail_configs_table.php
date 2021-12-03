<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_configs', function (Blueprint $table) {
            $table->id();
            $table->string('driver',510)->nullable();
            $table->string('host',510)->nullable();
            $table->string('port',510)->nullable();
            $table->string('username',510)->nullable();
            $table->string('password',510)->nullable();
            $table->string('encryption',510)->nullable();
            $table->string('from_address',510)->nullable();
            $table->string('to_address',510)->nullable();
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
        Schema::dropIfExists('mail_configs');
    }
}
