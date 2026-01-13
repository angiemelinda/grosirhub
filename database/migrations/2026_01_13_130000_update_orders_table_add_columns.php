<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Update status and payment_status enums to match the new values
            $table->enum('status', [
                'pending',
                'processing',
                'shipping',
                'completed',
                'cancelled'
            ])->default('pending')->change();

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'expired',
                'refunded'
            ])->default('pending')->change();

            // Add new columns
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->string('shipping_name')->nullable()->after('payment_proof');
            $table->string('shipping_phone')->nullable()->after('shipping_name');
            $table->text('shipping_address')->nullable()->after('shipping_phone');
            $table->string('shipping_city')->nullable()->after('shipping_address');
            $table->string('shipping_postal_code', 10)->nullable()->after('shipping_city');
            $table->decimal('shipping_cost', 15, 2)->default(0)->after('shipping_postal_code');
            $table->decimal('platform_fee', 15, 2)->default(0)->after('shipping_cost');
            $table->decimal('grand_total', 15, 2)->default(0)->after('platform_fee');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert status and payment_status enums
            $table->enum('status', [
                'belum_dibayar',
                'dikemas',
                'dikirim',
                'selesai'
            ])->default('belum_dibayar')->change();

            $table->enum('payment_status', [
                'menunggu_pembayaran',
                'sudah_dibayar'
            ])->default('menunggu_pembayaran')->change();

            // Drop added columns
            $table->dropColumn([
                'payment_method',
                'payment_proof',
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
