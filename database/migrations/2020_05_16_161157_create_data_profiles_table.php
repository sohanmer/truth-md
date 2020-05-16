<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('license')->nullable();
            $table->longText('content')->nullable(); 
            $table->text('name')->nullable();
            $table->text('phone')->nullable();
            $table->text('speciality')->nullable();
            $table->text('address')->nullable();
            $table->text('in_progress')->nullable();           
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
        Schema::dropIfExists('data_profiles');
    }
}
