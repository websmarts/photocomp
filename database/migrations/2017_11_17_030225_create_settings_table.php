<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->float('first_section_cost')->default(14);
            $table->float('additional_section_cost')->default(10);
            $table->float('digital_only_entry_surcharge')->default(2);
            $table->integer('max_entries_per_section')->default(4);
            $table->string('terms_and_conditions_url');
            $table->enum('competition_status', ['Open', 'Closed'])->default('Closed');
            $table->mediumText('return_instructions');
            $table->enum('paypal_mode', ['Sandbox', 'Live'])->default('Sandbox');
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
        Schema::dropIfExists('settings');
    }
}
