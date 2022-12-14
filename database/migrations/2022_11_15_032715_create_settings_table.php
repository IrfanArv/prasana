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
            $table->id();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->string('address');
            $table->integer('phone');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('gplus');
            $table->string('maps');
            $table->string('wa_number');
            $table->string('wa_message');
            $table->text('widget_book');
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
