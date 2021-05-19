<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title',191);            
            $table->text('description');
            $table->string('slug',191);
            $table->string('img',191)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('file',191)->nullable();
            $table->enum('status',['show','hide'])->default('show');
            $table->bigInteger('hit')->default(0);
            $table->string('created_by',191)->nullable();
            $table->string('updated_by',191)->nullable();
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
        Schema::dropIfExists('announcements');
    }
}
