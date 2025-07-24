<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessIdFieldToAccountssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accountss', function (Blueprint $table) {
            $table->integer('business_id')->unsigned()->nullable()->after('id');
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accountss', function (Blueprint $table) {
            //
        });
    }
}
