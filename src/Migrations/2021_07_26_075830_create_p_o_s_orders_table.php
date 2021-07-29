<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOSOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(config('badaso.database.prefix').'pos_orders')) {
            Schema::create(config('badaso.database.prefix').'pos_orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained(config('badaso.database.prefix').'users')->nullable();
                $table->foreignId('provider_id');
                $table->double('discounted')->default(0); // output discount
                $table->double('total')->default(0);
                $table->double('payed')->default(0);
                $table->double('refund')->default(0); // remaining money back
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
                $table->softDeletes('deleted_at');
            });

            Schema::table(config('badaso.database.prefix').'pos_orders', function (Blueprint $table) {
                $table->foreign('provider_id')->references('id')->on(config('badaso.database.prefix').'payment_providers');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'pos_orders');
    }
}
