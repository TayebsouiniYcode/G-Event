<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')
                ->references('id')
                ->references('id')
                ->on('events')->onDelete('cascade');
            $table->integer('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('ticket_id')
                ->references('id')
                ->on('tickets')->onDelete('cascade');
            $table->string('session_id');
            $table->decimal('total_price', 6, 2);
            $table->integer('numberOfTicket');
            $table->string('paymentStatus');
            $table->timestamps();
        });
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
};
