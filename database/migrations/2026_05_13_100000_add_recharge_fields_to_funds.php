<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRechargeFieldsToFunds extends Migration
{
    public function up()
    {
        Schema::table('funds', function (Blueprint $table) {
            if (!Schema::hasColumn('funds', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }
            if (!Schema::hasColumn('funds', 'transaction_id')) {
                $table->string('transaction_id')->nullable();
            }
            if (!Schema::hasColumn('funds', 'phone_number')) {
                $table->string('phone_number')->nullable();
            }
            if (!Schema::hasColumn('funds', 'payment_proof')) {
                $table->string('payment_proof')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('funds', function (Blueprint $table) {
            if (Schema::hasColumn('funds', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
            if (Schema::hasColumn('funds', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }
            if (Schema::hasColumn('funds', 'phone_number')) {
                $table->dropColumn('phone_number');
            }
            if (Schema::hasColumn('funds', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }
        });
    }
}
