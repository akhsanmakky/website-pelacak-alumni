<?php
/**
 * Debug script untuk check PDDIKTI API
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\PddiktiService;

$pddiktiService = new PddiktiService();

// Get some pending alumni to test
$alumni = DB::table('alumni')
    ->where('pddikti_status', 'pending')
    ->limit(5)
    ->get();

echo "=== Testing PDDIKTI API dengan 5 alumni ===\n\n";

foreach ($alumni as $a) {
    echo "Testing: {$a->nama} (NIM: {$a->nim})\n";
    
    $result = $pddiktiService->validateAlumni($a->nama, $a->nim);
    
    echo "  Result: {$result['status']}\n";
    echo "  Message: {$result['message']}\n\n";
}
