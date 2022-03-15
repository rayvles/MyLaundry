<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenjemputanlaundryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('tb_penjemputanlaundry', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_member')->constrained('tb_member')->cascadeOnUpdate();
                $table->string('petugas_penjemput', 120);
                $table->enum('status', ['tercatat', 'penjemputan', 'selesai']);
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
        Schema::dropIfExists('tb_penjemputanlaundry');
    }
}
