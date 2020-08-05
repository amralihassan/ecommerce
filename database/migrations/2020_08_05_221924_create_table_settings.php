<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siteNameArabic')->nullable();
            $table->string('siteNameEnglish')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('contact',50)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('youtube',100)->nullable();
            $table->string('arabicDescription')->nullable();
            $table->string('englishDescription')->nullable();
            $table->string('keywords')->nullable();
            $table->enum('status',['open','close'])->default('open');
            $table->string('messageMaintenance')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
