<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Check and update status enum if needed
        if (Schema::hasColumn('orders', 'status')) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'shipping', 'completed', 'cancelled') DEFAULT 'pending'");
        }

        // Check and update payment_status enum if needed
        if (Schema::hasColumn('orders', 'payment_status')) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed', 'expired', 'refunded') DEFAULT 'pending'");
        }

        // Add missing columns if they don't exist
        $columns = [
            'payment_method' => function($table) { $table->string('payment_method')->nullable(); },
            'payment_proof' => function($table) { $table->string('payment_proof')->nullable(); },
            'shipping_name' => function($table) { $table->string('shipping_name')->nullable(); },
            'shipping_phone' => function($table) { $table->string('shipping_phone')->nullable(); },
            'shipping_address' => function($table) { $table->text('shipping_address')->nullable(); },
            'shipping_city' => function($table) { $table->string('shipping_city')->nullable(); },
            'shipping_postal_code' => function($table) { $table->string('shipping_postal_code', 10)->nullable(); },
            'shipping_cost' => function($table) { $table->decimal('shipping_cost', 15, 2)->default(0); },
            'platform_fee' => function($table) { $table->decimal('platform_fee', 15, 2)->default(0); },
            'grand_total' => function($table) { $table->decimal('grand_total', 15, 2)->default(0); },
        ];

        foreach ($columns as $column => $callback) {
            if (!Schema::hasColumn('orders', $column)) {
                Schema::table('orders', function(Blueprint $table) use ($callback) {
                    $callback($table);
                });
            }
        }
    }

    public function down()
    {
        // Revert status enums to original values
        if (Schema::hasColumn('orders', 'status')) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('belum_dibayar', 'dikemas', 'dikirim', 'selesai') DEFAULT 'belum_dibayar'");
        }

        if (Schema::hasColumn('orders', 'payment_status')) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('menunggu_pembayaran', 'sudah_dibayar') DEFAULT 'menunggu_pembayaran'");
        }

        // Note: We're not dropping columns in the down method to prevent data loss
        // If you need to rollback, create a new migration to handle it
    }
};
