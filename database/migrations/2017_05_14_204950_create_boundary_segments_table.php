<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoundarySegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boundary_segments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beacon_id')->nullable();
            $table->integer('boundary_point_id');
            $table->integer('segment_no');
            $table->float('distance');
            $table->enum('from_side', ['left', 'right']);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boundary_segments');
    }
}
