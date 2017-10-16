<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title');
            $table->longText('description');
            $table->string('project_url');

            $table->integer('role_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->integer('social_media_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('social_media_id')->references('id')->on('social_media');

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
        Schema::dropIfExists('projects');
    }
}
