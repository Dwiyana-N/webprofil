<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title');
            $table->string('slug');
            $table->string('short_description');
            $table->text('content');
            $table->string('img')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->enum('status',['show','hide'])->default('show');
            $table->bigInteger('hit')->default(0);
            $table->SoftDeletes();
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
        Schema::dropIfExists('articles');
    }
}
