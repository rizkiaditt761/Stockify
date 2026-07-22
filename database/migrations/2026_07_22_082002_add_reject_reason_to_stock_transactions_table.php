<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE stock_transactions
            CHANGE reject_reason rejection_reason TEXT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE stock_transactions
            CHANGE rejection_reason reject_reason TEXT NULL
        ");
    }
};