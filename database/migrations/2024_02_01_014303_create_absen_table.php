<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->integer('No_absen')->unique();
            $table->string('Nama_Karyawan');
            $table->string('cabang');
            $table->string('posisi_jabatan');
            for ($i = 1; $i <= 31; $i++) {
                $table->string('hari' . $i)->nullable();
            }
            $table->string('tahun');
            $table->string('Bulan');
            // $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
}
