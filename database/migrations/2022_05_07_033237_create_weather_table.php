<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id');
            $table->string('condition', 100);
            $table->string('description');
            $table->enum('unit', [0, 1, 2])->comment("0: default (Kelvin, m/sec), 1: metric (Celsius, m/sec), 2: imperial (Fahrenheit, miles/hour)");
            $table->decimal('temperature');
            $table->integer('humidity_percent');
            $table->decimal('pressure');
            $table->decimal('min_temperature');
            $table->decimal('max_temperature');
            $table->integer('visibility_in_meter');
            $table->decimal('wind_speed');
            $table->integer('wind_degree');
            $table->integer('cloudiness_percent');
            $table->integer('rain_for_hour')->nullable()->comment('unit: mm');
            $table->integer('snow_for_hour')->nullable()->comment('unit: mm');
            $table->timestamp('time_of_data_calculation');
            $table->date('date');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather');
    }
};
