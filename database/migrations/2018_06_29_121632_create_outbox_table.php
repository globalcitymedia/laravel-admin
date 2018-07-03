<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbox', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_task_id')->unsigned()->nullable();

            $table->integer('locked_email_template_id')->unsigned()->nullable();

            $table->string('template_name')->nullable();
            $table->string('subject')->nullable();
            $table->text('email_body')->nullable();
            $table->string('from_address')->nullable();
            $table->string('display_name')->nullable();

            $table->integer('contact_id')->unsigned()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('id_key')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('outbox');
    }
}
