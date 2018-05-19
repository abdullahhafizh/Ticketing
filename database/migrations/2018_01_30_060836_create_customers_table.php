<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('address');
            $table->string('phone')->unique();
            $table->string('gender');
            $table->timestamps();
        });
        $statement = "ALTER TABLE customers AUTO_INCREMENT = 200001;";
        DB::unprepared($statement);
        DB::table('customers')->insert(
            array(                
                'name' => 'Customer 1',
                'address' => 'DKI Jakarta',
                'phone' => '1234567890',
                'gender' => 'Male',
            )
        );
        DB::table('customers')->insert(
            array(                
                'name' => 'Customer 2',
                'address' => 'DKI Jakarta',
                'phone' => '2345678901',
                'gender' => 'Female',
            )
        );
        DB::table('customers')->insert(
            array(                
                'name' => 'Customer 3',
                'address' => 'DKI Jakarta',
                'phone' => '3456789012',
                'gender' => 'Other',
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
        Schema::dropIfExists('customers');
    }
}
