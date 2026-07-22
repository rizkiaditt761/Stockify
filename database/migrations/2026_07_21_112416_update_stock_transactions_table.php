<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom baru
        Schema::table('stock_transactions', function (Blueprint $table) {

            $table->foreignId('confirmed_by')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->dateTime('confirmed_at')
                ->nullable()
                ->after('transaction_date');

            $table->text('rejection_reason')
                ->nullable()
                ->after('notes');

        });

        // Ubah enum status
        DB::statement("
            ALTER TABLE stock_transactions
            MODIFY status
            ENUM(
                'Pending',
                'Completed',
                'Rejected',
                'Cancelled'
            )
            NOT NULL
            DEFAULT 'Pending'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE stock_transactions
            MODIFY status
            ENUM(
                'Pending',
                'Completed',
                'Cancelled'
            )
            NOT NULL
            DEFAULT 'Completed'
        ");

        Schema::table('stock_transactions', function (Blueprint $table) {

            $table->dropForeign(['confirmed_by']);

            $table->dropColumn([
                'confirmed_by',
                'confirmed_at',
                'rejection_reason',
            ]);

        });
    }
};