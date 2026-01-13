<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First, check if we need to modify the status and payment_status enums
        $this->modifyEnums();
        
        // Then add any missing columns
        $this->addMissingColumns();
    }

    public function down()
    {
        // Note: We're not implementing down() to prevent data loss
        // Create a new migration if you need to rollback
    }

    private function modifyEnums()
    {
        try {
            // Update status enum if it exists
            if (Schema::hasColumn('orders', 'status')) {
                DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'shipping', 'completed', 'cancelled') DEFAULT 'pending'");
            }

            // Update payment_status enum if it exists
            if (Schema::hasColumn('orders', 'payment_status')) {
                DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed', 'expired', 'refunded') DEFAULT 'pending'");
            }
        } catch (\Exception $e) {
            \Log::error('Error modifying enums: ' . $e->getMessage());
        }
    }

    private function addMissingColumns()
    {
        $columns = [
            'payment_method' => 'VARCHAR(255) NULL AFTER `payment_status`',
            'payment_proof' => 'VARCHAR(255) NULL AFTER `payment_method`',
            'shipping_name' => 'VARCHAR(255) NULL AFTER `payment_proof`',
            'shipping_phone' => 'VARCHAR(20) NULL AFTER `shipping_name`',
            'shipping_address' => 'TEXT NULL AFTER `shipping_phone`',
            'shipping_city' => 'VARCHAR(100) NULL AFTER `shipping_address`',
            'shipping_postal_code' => 'VARCHAR(10) NULL AFTER `shipping_city`',
            'shipping_cost' => 'DECIMAL(15,2) DEFAULT 0 AFTER `shipping_postal_code`',
            'platform_fee' => 'DECIMAL(15,2) DEFAULT 0 AFTER `shipping_cost`',
            'grand_total' => 'DECIMAL(15,2) DEFAULT 0 AFTER `platform_fee`',
        ];

        foreach ($columns as $column => $definition) {
            try {
                if (!Schema::hasColumn('orders', $column)) {
                    DB::statement("ALTER TABLE orders ADD COLUMN {$column} {$definition}");
                }
            } catch (\Exception $e) {
                \Log::error("Error adding column {$column}: " . $e->getMessage());
                continue;
            }
        }
    }
};
