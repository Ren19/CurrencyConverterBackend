<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTableNew extends Migration
{
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('source_currency', 3);
            $table->string('target_currency', 3);
            $table->decimal('rate', 15, 4);
            $table->timestamps();
            $table->unique(['source_currency', 'target_currency']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
