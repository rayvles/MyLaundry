<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 120);
            $table->dateTime('waktu_pakai');
            $table->timestamp('waktu_beres_status')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama_pemakai', 120);
            $table->enum('status_barang', ['selesai', 'belum_selesai']);

            // ->nullable()->default(now())
            ;
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
        Schema::dropIfExists('tb_barang');
    }
}
