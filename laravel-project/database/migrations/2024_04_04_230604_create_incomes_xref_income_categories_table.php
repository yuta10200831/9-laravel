<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesXrefIncomeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes_xref_income_categories', function (Blueprint $table) {
            $table->foreignId('income_id')->constrained('incomes')->onDelete('cascade');
            $table->foreignId('income_category_id')->constrained('income_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incomes_xref_income_categories');
    }
}