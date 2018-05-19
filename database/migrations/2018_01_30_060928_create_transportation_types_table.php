<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamps();
        });
        $statement = "ALTER TABLE transportation_types AUTO_INCREMENT = 300001;";
        DB::unprepared($statement);
        DB::table('transportation_types')->insert(
            array(                
                'description' => 'Bussines',                
            )
        );
        DB::table('transportation_types')->insert(
            array(                
                'description' => 'Economy',
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
        Schema::dropIfExists('transportation_types');
    }
}
