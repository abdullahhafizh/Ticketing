<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_code');
            $table->text('reservation_at');
            $table->date('reservation_date');
            $table->integer('customerid')->unsigned();
            $table->foreign('customerid')->references('id')->on('customers')->onDelete('cascade');
            $table->string('seat_code');
            $table->integer('routeid')->unsigned();
            $table->foreign('routeid')->references('id')->on('routes')->onDelete('cascade');
            $table->text('depart_at');
            $table->integer('price');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        $statement = "ALTER TABLE reservations AUTO_INCREMENT = 600001;";
        DB::unprepared($statement);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
