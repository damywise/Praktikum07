<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('userIdPetugas')->nullable();
            $table->unsignedBigInteger('userIdPeminjam')->nullable();
            $table->date('tanggalPinjam')->nullable();
            $table->date('tanggalSelesai')->nullable();
            $table->timestamps();
            
            $table->foreign('userIdPetugas', 'transactions_FK')->references('id')->on('users');
            $table->foreign('userIdPeminjam', 'transactions_FK_1')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
