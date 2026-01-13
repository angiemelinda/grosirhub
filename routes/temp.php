<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/temp/check-db', function() {
    try {
        // Get the columns from the orders table
        $columns = DB::select('DESCRIBE orders');
        
        // Get the first order to check data
        $order = DB::table('orders')->first();
        
        return [
            'columns' => $columns,
            'first_order' => $order
        ];
        
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ];
    }
});
