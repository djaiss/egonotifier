<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('url');
            $table->boolean('valid')->default(true);
            $table->integer('current_level')->default(0);
            $table->timestamps();
            $table->index('url');
        });

        Schema::create('source_user', function (Blueprint $table) {
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('source_id');
            $table->integer('value');
            $table->timestamps();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
        });
    }
}
