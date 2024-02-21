<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('blog_category_id')->unsigned();
            $table->foreign('blog_category_id')
                ->references('id')->on('blog_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title');
            $table->text('contents');
            $table->string('image_path');

            $table->integer('updated_by')->unsigned();
            $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
