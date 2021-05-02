<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('author');
            $table->string('comment_content');
	    $table->foreignId('post_id')->nullable();
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
        //
    }
}
