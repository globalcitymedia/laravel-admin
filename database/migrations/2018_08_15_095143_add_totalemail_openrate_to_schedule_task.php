<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalemailOpenrateToScheduleTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_tasks', function (Blueprint $table) {
            $table->integer('total_emails_sent')->unsigned()->nullable();
            $table->integer('delivered')->unsigned()->nullable();
            $table->integer('bounced')->unsigned()->nullable();
            $table->integer('opened')->unsigned()->nullable();
            $table->integer('clicked')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_tasks', function (Blueprint $table) {
            $table->dropColumn(['total_emails_sent', 'delivered', 'bounced','opened','clicked']);
        });
    }
}
