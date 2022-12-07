<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('transactionId')->nullable()->index('detail_transactions_FK_1');
            $table->unsignedBigInteger('collectionId')->nullable()->index('detail_transactions_FK');
            $table->date('tanggalKembali')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('keterangan', 100)->nullable();
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
        Schema::dropIfExists('detail_transactions');
    }
}
