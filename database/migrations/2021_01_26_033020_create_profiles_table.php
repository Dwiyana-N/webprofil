<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // $table->text('selayang_pandang');
            // $table->text('sejarah');
            // $table->text('visi_misi');
            // $table->text('tugas_wewenang');
            // $table->text('struktur_organisasi');
            // $table->text('sambutan_ketua');
            $table->string('title');
            $table->string('slug');
            $table->string('img')->nullable();
            $table->string('file')->nullable();
            $table->text('description');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->enum('status',['show','hide'])->default('show');
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
        Schema::dropIfExists('profiles');
    }
}
