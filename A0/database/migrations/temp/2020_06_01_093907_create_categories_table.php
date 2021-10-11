<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'categories', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
//            $table->integer( 'parent_id' )->nullable()->index();
            $table->integer( 'lft' )->nullable()->index();
            $table->integer( 'rgt' )->nullable()->index();
            $table->integer( 'depth' )->nullable();
            $table->string( 'ordering' )->nullable()->index();

            $table->string( 'title' );
            $table->string( 'slug' );
            $table->text( 'content' )->nullable();
            $table->string( 'author_name' )->nullable();
            $table->unsignedBigInteger( 'author_id' );
            $table->unsignedBigInteger( 'image_id' )->nullable();
            $table->string( 'keywords' )->nullable();
            $table->text( 'description' )->nullable();
            $table->string( 'page_class' )->nullable();
            $table->integer( 'hits' )->default( 0 );


            $table->integer( 'status' );
            $table->unsignedBigInteger( 'created_by' );
            $table->unsignedBigInteger( 'updated_by' );
            $table->timestamps();
            $table->softDeletes();
            $table->nestedSet();
        } );

        Schema::table( 'categories', function ( Blueprint $table ) {
            $table->foreign( 'author_id' )
                  ->references( 'id' )
                  ->on( 'users' );
            $table->foreign( 'created_by' )
                  ->references( 'id' )
                  ->on( 'users' );
            $table->foreign( 'updated_by' )
                  ->references( 'id' )
                  ->on( 'users' );
            $table->foreign( 'image_id' )
                  ->references( 'id' )
                  ->on( 'media' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement( 'SET FOREIGN_KEY_CHECKS = 0' );
//        Schema::drop( 'categories' );
        DB::statement( 'SET FOREIGN_KEY_CHECKS = 1' );
    }

}
