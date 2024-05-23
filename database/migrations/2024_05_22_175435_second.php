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
        Schema::table('user_dishes', function (Blueprint $table) {
            //
                $table->integer('dish_yield');
                
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_dishes', function (Blueprint $table) {
            //
            $table->dropColumn('dish_yield');
        });
    }
};
