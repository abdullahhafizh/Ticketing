<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->integer('level')->default(1);            
            $table->rememberToken();
            $table->timestamps();
        });
        $statement = "ALTER TABLE users AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);
        DB::table('users')->insert(
            array(                
                'username' => 'adminadmin',
                'password' => bcrypt('adminadmin'),
                'fullname' => 'Admin',
                'level' => '2',                
            )
        );
        DB::table('users')->insert(
            array(                
                'username' => 'useruser',
                'password' => bcrypt('useruser'),
                'fullname' => 'User',
                'level' => '1',
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
        Schema::dropIfExists('users');
    }
}
