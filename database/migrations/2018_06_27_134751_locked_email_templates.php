<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LockedEmailTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('locked_email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('email_templates_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->text('email_body')->nullable();
            $table->string('from_address')->nullable();
            $table->string('display_name')->nullable();
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
        Schema::dropIfExists('locked_email_templates');
    }
}
