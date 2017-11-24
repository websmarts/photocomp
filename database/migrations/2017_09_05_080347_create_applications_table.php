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
            $table->integer('user_id')->unsigned();
            $table->enum('salutation', ['Mr', 'Mrs', 'Ms', 'Miss', 'Dr'])->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('honours')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('vaps_affiliated')->nullable();
            $table->string('aps_member')->nullable();
            $table->string('club_nomination')->nullable();
            $table->string('confirm_terms')->nullable();

            $table->integer('number_of_entries')->unsigned()->default(0);
            $table->integer('number_of_sections')->unsigned()->default(0);
            $table->string('return_postage')->nullable();
            $table->string('return_post_option')->nullable();
            $table->float('entries_cost')->default(0);
            //$table->float('total_amount_charged')->nullable();
            $table->boolean('submitted')->default(false);
            //$table->float('payment_received_amount')->nullable();
            $table->datetime('payment_datetime')->nullable();
            $table->string('payment_method')->nullable();

            //$table->enum('status', ['open', 'closed'])->default('open');
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
