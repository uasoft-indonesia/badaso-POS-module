<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOSEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(config('badaso.database.prefix').'pos_employees')) {
            Schema::create(config('badaso.database.prefix').'pos_employees', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained(config('badaso.database.prefix').'users');
                $table->string('name')->nullable();
                $table->string('address_line1', 255)->nullable();
                $table->string('address_line2', 255)->nullable();
                $table->string('city', 255)->nullable();
                $table->string('postal_code', 10)->nullable();
                $table->string('country', 255)->nullable();
                $table->string('telephone', 15)->nullable();
                $table->string('mobile', 15)->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists(config('badaso.database.prefix').'pos_employees');
    }
}
