<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->char('status');
            $table->timestamp('timestamp')->nullable();
            $table->char('bank_code');
            $table->string('account_number');
            $table->string('beneficiary_name');
            $table->string('remark');
            $table->string('receipt')->nullable();;
            $table->timestamp('time_served')->nullable();
            $table->bigInteger('fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursements');
    }
}
