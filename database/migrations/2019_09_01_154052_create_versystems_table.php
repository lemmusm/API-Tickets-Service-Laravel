<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versystems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version_app', 10);
            $table->string('version_code', 50);
            $table->string('version_name', 50);
            $table->string('version_registry', 50);
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
        Schema::dropIfExists('versystems');
    }
}
