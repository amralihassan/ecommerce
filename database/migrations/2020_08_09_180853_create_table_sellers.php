<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSellers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seller_name',50);
            $table->string('mobile',15);
            $table->string('email',50)->nullable();
            $table->enum('activition',['active','not active'])->default('not active');
            $table->string('address',150)->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
