<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('bookid');
            $table->string('carid');
            $table->string('cid');
            $table->string('pickup');
            $table->string('destination');
            $table->date('bookdate');
            $table->time('starttime');
            $table->time('endtime');
            $table->string('offer')->nullable();
            $table->string('status')->default('pending');
            $table->string('response')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
