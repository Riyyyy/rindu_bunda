<?php 
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Topping;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Check if table 'topping' exists: " . (Schema::hasTable('topping') ? 'Yes' : 'No') . "\n";
    if (Schema::hasTable('topping')) {
        echo "Check if column 'kode_topping' exists: " . (Schema::hasColumn('topping', 'kode_topping') ? 'Yes' : 'No') . "\n";
    }
    
    $kd = Topping::getKodeTopping();
    echo "Next Kode Topping: $kd\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
