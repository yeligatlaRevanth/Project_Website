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
        //database/migrations/<creation_date_>create_messages_table.php
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //insert the lines below
            $table->integer('user_id')->unsigned();
            $table->text('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
