<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'tags', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->string( 'name' );
            $table->integer( 'type' );

            $table->timestamps();
            $table->softDeletes();
        } );
        Schema::create( 'taggables', function ( Blueprint $table ) {
            $table->unsignedInteger( 'tag_id' );
            $table->morphs( 'taggable' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement( 'SET FOREIGN_KEY_CHECKS = 0' );
//        Schema::drop( 'tags' );
//        Schema::drop( 'taggables' );
        DB::statement( 'SET FOREIGN_KEY_CHECKS = 1' );

    }
}
