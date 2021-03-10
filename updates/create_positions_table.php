<?php namespace Depcore\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePositionsTable extends Migration
{
    public function up()
    {
        Schema::create('depcore_contact_positions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depcore_contact_positions');
    }
}
