<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('commission_amount', 10, 2)->nullable()->after('total_amount');
            $table->decimal('commission_rate', 6, 4)->nullable()->after('commission_amount');
            $table->string('commission_type')->nullable()->after('commission_rate');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['commission_amount', 'commission_rate', 'commission_type']);
        });
    }
};
