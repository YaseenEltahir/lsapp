<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionIdToEssays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('essays', function($table){
            $table->integer('subscription_id');
            $table->foreign('subscription_id')->references('subscription_id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('essays', function($table){
            $table->dropColumn('subscription_id');
            $table->dropForeign('subscription_id');

        });
    }
}
