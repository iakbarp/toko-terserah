<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOccupancyIdToAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alamat', function (Blueprint $table) {
            $table->foreignId('occupancy_id');
            $table->foreign('occupancy_id')->references('id')->on('occupancy_types')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alamat', function (Blueprint $table) {
            $table->dropColumn('occupancy_id');
            $table->dropForeign('occupancy_id');
        });
    }
}
