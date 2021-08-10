<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',255);
            $table->string('company_address',255);
            $table->char('company_tel',11);
            $table->char('company_fax',11);
            $table->char('estimate_No',15);
            $table->string('project_name',255);
            $table->string('item_name',255);
            $table->double('amout',20);
            $table->date('today');
            $table->date('expire_day');
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
        Schema::dropIfExists('bill');
    }
}
