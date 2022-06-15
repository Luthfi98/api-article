<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title', 200);
            $table->text('content');
            $table->string('category', 100);
            $table->timestamp('created_date')->useCurrent();
            $table->timestamp('updated_date')->nullable()->useCurrentOnUpdate();;
            $table->enum('status', ['Publish', 'Draft', 'Trash']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
