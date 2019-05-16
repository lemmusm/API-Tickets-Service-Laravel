<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id_ticket');
            $table->string('usuario_uid');
            $table->string('servicio', 50);
            $table->string('descripcion', 1500);
            $table->string('diagnostico', 1500)->nullable();
            $table->string('filesattach', 256)->nullable();
            $table->string('tecnico', 50)->nullable();
            $table->string('status', 20);
            $table->timestamps();
        });

        DB::update('ALTER TABLE tickets AUTO_INCREMENT = 10000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
