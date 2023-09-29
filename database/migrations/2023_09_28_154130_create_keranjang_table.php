<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('makanan_id'); // Kolom untuk menyimpan ID makanan yang ada dalam keranjang
            $table->integer('jumlah'); // Jumlah makanan dalam keranjang
            $table->timestamps();

            // Menambahkan foreign key ke tabel makanan
            $table->foreign('makanan_id')->references('id')->on('makanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjang');
    }
}
