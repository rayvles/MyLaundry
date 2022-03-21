<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLogging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logging', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->timestamp('datetime');
        });

        DB::unprepared(
            'CREATE TRIGGER `INSERT PENJEMPUTAN LAUNDRY`
                AFTER INSERT ON `tb_penjemputanlaundry` FOR EACH ROW
                BEGIN
                    INSERT INTO `logging` (`action`, `datetime`) VALUES("INSERT PENJEMPUTAN LAUNDRY", NOW());
                END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('logging');
        DB::unprepared('DROP TRIGGER IF EXISTS `INSERT PENJEMPUTAN LAUNDRY`');
    }
}
