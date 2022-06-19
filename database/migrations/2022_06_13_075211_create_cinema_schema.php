<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        
        Schema::create('administration', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('location', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('street');
            $table->string('city', 50);
            $table->string('state', 2);
            $table->string('zip', 12);
            $table->string('phone', 30)->nullable();
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->integer('administration_id')->unsigned()->nullable();
            $table->foreign('administration_id')->references('id')->on('administration');
            $table->timestamps();
        });

        Schema::create('screen', function($table) {
            $table->increments('id');
            $table->string('screen_name');
            $table->string('screen_code');
            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('location');
            $table->timestamps();
        });

        Schema::create('movie', function($table) {
            $table->increments('id');
            $table->time('start');
            $table->time('end');
            $table->integer('screen_id')->unsigned();
            $table->foreign('screen_id')->references('id')->on('screen')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        // Schema::create('price', function($table) {
        //     $table->increments('id');
        //     $table->time('start');
        //     $table->time('end');
        //     $table->integer('screen_id')->unsigned();
        //     $table->foreign('screen_id')->references('id')->on('screen')->onDelete('cascade');
        //     $table->string('name');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
