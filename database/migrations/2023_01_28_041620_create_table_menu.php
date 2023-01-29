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
        Schema::create('menu_level', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->timestamps();
        });
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_level');
            $table->bigInteger('parent_id')->nullable();
            $table->string('menu_name');
            $table->string('menu_link');
            $table->string('menu_icon')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('menu_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('menu_id');
            $table->bigInteger('update_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_photo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('foto');
            $table->bigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_photo');
        Schema::dropIfExists('menu_user');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_level');
    }
};
