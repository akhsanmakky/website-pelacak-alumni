<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Alumni;
use Illuminate\Support\Facades\DB;

$total = Alumni::count();
$verified = Alumni::where('pddikti_status', 'verified')->count();
$notFound = Alumni::where('pddikti_status', 'not_found')->count();
$nullStatus = Alumni::whereNull('pddikti_status')->count();
$withStatus = Alumni::whereNotNull('pddikti_status')->count();
$error = Alumni::where('pddikti_status', 'error')->count();

echo "=== Alumni Status ===\n";
echo "Total Alumni: $total\n";
echo "PDDIKTI Verified: $verified\n";
echo "PDDIKTI Not Found: $notFound\n";
echo "PDDIKTI Error: $error\n";
echo "PDDIKTI Null: $nullStatus\n";
echo "With Status (any): $withStatus\n";

// Breakdown by status
echo "\n=== Breakdown by pddikti_status ===\n";
$statuses = DB::table('alumni')
    ->select('pddikti_status', DB::raw('count(*) as count'))
    ->groupBy('pddikti_status')
    ->get();

foreach ($statuses as $status) {
    echo "  {$status->pddikti_status}: {$status->count}\n";
}

// Auto Ready
$autoReady = Alumni::autoReady()->count();
echo "\nAuto Ready for Tracking: $autoReady\n";

// Check profiles
$profiles = DB::table('alumni_profiles')->count();
echo "Profiles created: $profiles\n";
