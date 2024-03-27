<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendingsTable extends Migration
{
    public function up()
    {
        Schema::create('spendings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->date('accrual_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spendings');
    }
}