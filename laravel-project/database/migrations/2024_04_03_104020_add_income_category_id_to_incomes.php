<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncomeCategoryIdToIncomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('incomes', function (Blueprint $table) {
        //     $table->unsignedBigInteger('income_category_id')->nullable()->after('income_source_id');
        //     $table->foreign('income_category_id')->references('id')->on('income_categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign('incomes_income_category_id_foreign');
            // カラムを削除
            $table->dropColumn('income_category_id');
        });
    }
}