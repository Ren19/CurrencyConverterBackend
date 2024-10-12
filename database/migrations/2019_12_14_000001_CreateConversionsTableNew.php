<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionsTableNew extends Migration
{
    public function up()
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('source_currency', 3);
            $table->string('target_currency', 3);
            $table->decimal('original_amount', 15, 2);
            $table->decimal('converted_amount', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->integer('created_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversions');
    }
}
