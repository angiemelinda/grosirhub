<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_name')->after('margin')->nullable();
            $table->string('shipping_phone')->after('shipping_name')->nullable();
            $table->text('shipping_address')->after('shipping_phone')->nullable();
            $table->string('shipping_city')->after('shipping_address')->nullable();
            $table->string('shipping_postal_code', 10)->after('shipping_city')->nullable();
            $table->decimal('shipping_cost', 15, 2)->after('shipping_postal_code')->default(0);
            $table->decimal('platform_fee', 15, 2)->after('shipping_cost')->default(0);
            $table->decimal('grand_total', 15, 2)->after('platform_fee')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_name',
                'shipping_phone',
                'shipping_address',
                'shipping_city',
                'shipping_postal_code',
                'shipping_cost',
                'platform_fee',
                'grand_total'
            ]);
        });
    }
};
