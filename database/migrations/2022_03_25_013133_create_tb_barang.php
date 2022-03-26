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
            $table->integer('qty');
            $table->double('harga');
            $table->dateTime('waktu_beli');
            $table->string('supplier', 120);
            $table->enum('status_barang', ['diajukan_beli', 'habis', 'tersedia']);
            $table->timestamp('waktu_updated_status')->nullable()->useCurrent()->useCurrentOnUpdate()
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
