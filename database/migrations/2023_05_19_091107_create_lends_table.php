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
        Schema::create('lends', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->date('lend_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')
                ->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')
                ->onDelete('cascade');

            $table->unique(['member_id', 'stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lends');
    }
};
