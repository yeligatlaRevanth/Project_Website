<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('user_dishes', function(Blueprint $table){
            $table->increments('id');
            $table->string('dish_email');
            $table->mediumText('dish_image')->nullable();
            $table->string('dish_name');
            $table->string('dish_cuisine');
            $table->string('dish_ingredients')->nullable();
            $table->string('dish_dir');
            $table->string('dish_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user_dishes');
    }
};
