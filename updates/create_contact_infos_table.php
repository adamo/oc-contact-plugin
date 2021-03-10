<?php namespace Depcore\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateContactInfosTable extends Migration
{
    public function up()
    {
        Schema::create('depcore_contact_contact_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('emails')->nullable();
            $table->text('phones')->nullable();
            $table->text('address')->nullable();
            $table->integer('contact_id')->unsigned()->index()->nullable(  );
            $table->string('contact_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depcore_contact_contact_infos');
    }
}
