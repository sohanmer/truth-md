<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDataProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_profile', function (Blueprint $table) {
            $table->text('name')->nullable()->after('license');
            $table->text('phone')->nullable()->after('license');
            $table->text('speciality')->nullable()->after('license');
            $table->text('address')->nullable()->after('license');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_profile', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('speciality');
            $table->dropColumn('address');
        });
    }
}
