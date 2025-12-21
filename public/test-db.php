<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

// Load environment variables
$app->loadEnvironmentFrom('.env');
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$db = new DB;

$db->addConnection([
    'driver'    => env('DB_CONNECTION', 'mysql'),
    'host'      => env('DB_HOST', '127.0.0.1'),
    'port'      => env('DB_PORT', '3306'),
    'database'  => env('DB_DATABASE', 'forge'),
    'username'  => env('DB_USERNAME', 'forge'),
    'password'  => env('DB_PASSWORD', ''),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

$db->setEventDispatcher(new Dispatcher(new Container));
$db->setAsGlobal();
$db->bootEloquent();

echo "<pre>";
try {
    // Test connection
    DB::connection()->getPdo();
    echo "✅ Connected successfully to database: " . env('DB_DATABASE') . "\n";
    
    // Check if users table exists
    if (!DB::getSchemaBuilder()->hasTable('users')) {
        die("❌ Error: 'users' table does not exist in the database.\n");
    }
    
    // Try to insert a test user
    $userId = DB::table('users')->insertGetId([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => password_hash('test123', PASSWORD_DEFAULT),
        'phone' => '081234567893',
        'role' => 'test',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "✅ Test user inserted with ID: $userId\n";
    
    // Show all users
    $users = DB::table('users')->get();
    echo "\n📋 Current users in the database:\n";
    print_r($users->toArray());
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    
    // Show database configuration (without password)
    echo "\n🔧 Database Configuration:\n";
    echo "Host: " . env('DB_HOST') . "\n";
    echo "Database: " . env('DB_DATABASE') . "\n";
    echo "Username: " . env('DB_USERNAME') . "\n";
    echo "Port: " . env('DB_PORT', '3306') . "\n";
}

echo "</pre>";
