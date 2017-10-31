<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('salutation', ['Mr', 'Mrs', 'Ms', 'Miss', 'Dr'])->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('honours')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->string('vaps_affiliated')->nullable();
            $table->string('aps_member')->nullable();
            $table->string('club_nomination')->nullable();
            $table->string('return_postage')->nullable();
            $table->string('return_post_option')->nullable();
            $table->float('amount_charged')->nullable();
            $table->float('amount_paid')->nullable();
            $table->float('payment_received_amount')->nullable();
            $table->datetime('payment_received_datetime')->nullable();
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
