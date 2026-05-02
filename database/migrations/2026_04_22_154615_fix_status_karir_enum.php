<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE alumni 
            MODIFY status_karir ENUM('Bekerja', 'Wirausaha', 'Studi Lanjut', 'Belum Diketahui') 
            DEFAULT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE alumni 
            MODIFY status_karir ENUM('PNS', 'Swasta', 'Wirausaha')
        ");
    }
};