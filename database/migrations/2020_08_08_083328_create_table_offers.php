<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_offer_name',50);
            $table->string('title',150);
            $table->string('link',150);
            $table->enum('status_display',['yes','no'])->default('no');
            $table->enum('start_offer',['active',''])->nullable()->default('');
            $table->datetime('start_display');
            $table->datetime('end_display');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('offers');
    }
}
