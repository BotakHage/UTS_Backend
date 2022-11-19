<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            //Id Pasien
            $table->id();

            //Nama Pasien
            $table->string('name');

            //No HP Pasien
            $table->string('phone');

            //Alamat Pasien
            $table->text('address');

            //Status Pasien
            $table->string('status');

            //Tanggal Masuk
            $table->date('in_date_at');

            //Tanggal Keluar
            $table->date('out_date_at');

            //Timestamps
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
        Schema::dropIfExists('patients');
    }
};
