<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWastagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('medicine');
            $table->integer('manufacture');
            $table->integer('quantity');
            $table->integer('wastage_type');
            $table->integer('purchase_price');
            $table->timestamp('date');
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
        Schema::dropIfExists('wastages');
    }
}
