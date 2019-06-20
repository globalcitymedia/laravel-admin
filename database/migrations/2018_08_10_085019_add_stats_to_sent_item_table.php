<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatsToSentItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sent_items', function (Blueprint $table) {
            $table->string('status_code')->nullable();
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
        Schema::table('sent_items', function (Blueprint $table) {
            $table->dropColumn(['status_code','delivered', 'opened', 'bounced','clicked']);
        });
    }
}
