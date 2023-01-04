<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('barcode')->nullable();
            $table->string('generic_name');
            $table->string('strength')->nullable();
            $table->string('half_life')->nullable();
            $table->date('manDate');
            $table->date('exDate');
            $table->integer('stock')->change();
            $table->string('purchase_price');
            $table->string('selling_price');
            $table->integer('manufacturer_id');
            $table->integer('supplier_id');
            $table->integer('category_id');
            $table->integer('medicine_type_id');
            $table->string('image')->nullable();
            $table->longText('indicator')->nullable();
            $table->longText('missed_dose')->nullable();
            $table->longText('dosage')->nullable();
            $table->longText('precaution')->nullable();
            $table->longText('side_effect')->nullable();
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
        Schema::dropIfExists('medicines');
    }
}
