<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id()->unique();//資料ID
            $table->bigInteger('ISBN_number')->length(13);//ISBN番号
            $table->date('arrival_date');//入荷年月日
            $table->date('waste_date')->nullable();//廃棄年月日
            $table->text('remark')->nullable();//備考
            $table->foreign('ISBN_number')->references('ISBN_number')->on('documents')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
