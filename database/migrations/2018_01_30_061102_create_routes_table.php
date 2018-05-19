<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('depart_at');
            $table->text('route_from');
            $table->text('route_to');
            $table->integer('price');
            $table->integer('transportationid')->unsigned();
            $table->foreign('transportationid')->references('id')->on('transportations')->onDelete('cascade');
            $table->timestamps();
        });
        $statement = "ALTER TABLE routes AUTO_INCREMENT = 500001;";
        DB::unprepared($statement);
        DB::table('routes')->insert(
            array(
                'depart_at' => 'Departure 1',
                'route_from' => 'A',
                'route_to' => 'Z',
                'price' => '200000',
                'transportationid' => '400001',
            )
        );
        DB::table('routes')->insert(
            array(
                'depart_at' => 'Departure 2',
                'route_from' => 'Z',
                'route_to' => 'A',
                'price' => '100000',
                'transportationid' => '400002',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
