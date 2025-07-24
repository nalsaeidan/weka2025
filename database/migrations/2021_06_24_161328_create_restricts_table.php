<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restricts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('business_id')->unsigned()->nullable();
                $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');            
                $table->unsignedBigInteger('reference_number')->nullable();
                $table->longText('notes')->nullable();
                // $table->bigInteger('journal_number')->autoIncrement();
                $table->string('date')->nullable();
                $table->string('currency_id')->nullable();
                // $table->foreign('currency_id')->references('id')->on('currencies');
                $table->unsignedBigInteger('account_number1')->nullable();
                $table->text('description1')->nullable();
                $table->unsignedBigInteger('debit1')->nullable();
                $table->unsignedBigInteger('credit1')->nullable();

                $table->unsignedBigInteger('account_number2')->nullable();
                $table->text('description2')->nullable();
                $table->unsignedBigInteger('debit2')->nullable();
                $table->unsignedBigInteger('credit2')->nullable();

                $table->unsignedBigInteger('account_number3')->nullable();
                $table->text('description3')->nullable();
                $table->unsignedBigInteger('debit3')->nullable();
                $table->unsignedBigInteger('credit3')->nullable();

                $table->unsignedBigInteger('account_number4')->nullable();
                $table->text('description4')->nullable();
                $table->unsignedBigInteger('debit4')->nullable();
                $table->unsignedBigInteger('credit4')->nullable();

                $table->unsignedBigInteger('account_number5')->nullable();
                $table->text('description5')->nullable();
                $table->unsignedBigInteger('debit5')->nullable();
                $table->unsignedBigInteger('credit5')->nullable();
                
                $table->unsignedBigInteger('account_number6')->nullable();
                $table->text('description6')->nullable();
                $table->unsignedBigInteger('debit6')->nullable();
                $table->unsignedBigInteger('credit6')->nullable();
                
                $table->unsignedBigInteger('account_number7')->nullable();
                $table->text('description7')->nullable();
                $table->unsignedBigInteger('debit7')->nullable();
                $table->unsignedBigInteger('credit7')->nullable();
                
                $table->unsignedBigInteger('account_number8')->nullable();
                $table->text('description8')->nullable();
                $table->unsignedBigInteger('debit8')->nullable();
                $table->unsignedBigInteger('credit8')->nullable();
                
                $table->unsignedBigInteger('account_number9')->nullable();
                $table->text('description9')->nullable();
                $table->unsignedBigInteger('debit9')->nullable();
                $table->unsignedBigInteger('credit9')->nullable();
                
                $table->unsignedBigInteger('account_number10')->nullable();
                $table->text('description10')->nullable();
                $table->unsignedBigInteger('debit10')->nullable();
                $table->unsignedBigInteger('credit10')->nullable();
                
                $table->string('file')->nullable();
                $table->text('status')->default('نشط');
                $table->string('user_id');
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('restricts');
    }
}
