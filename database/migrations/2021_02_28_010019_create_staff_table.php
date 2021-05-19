<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->nullable();
            //$table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');            
            $table->string('nip')->unique()->nullable();
            $table->string('name');
            $table->string('birthplace')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender',['male','female']);
            $table->string('photo')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('position');
            $table->string('golongan')->nullable();
            $table->text('address');
            $table->enum('kadis',['1','0'])->default('0');
            $table->enum('status',['show','hide'])->default('show');
            $table->enum('kategori',['guru','non-guru']);
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
        Schema::dropIfExists('staff');
    }
}
