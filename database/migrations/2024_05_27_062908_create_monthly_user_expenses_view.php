<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS MonthlyUserExpenses');

        DB::unprepared('
            CREATE VIEW MonthlyUserExpenses AS
            SELECT
                user_id,
                YEAR(date) as year,
                MONTH(date) as month,
                COALESCE(SUM(amount), 0) as total_expenses
            FROM expenses
            GROUP BY user_id, year, month;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS MonthlyUserExpenses');
    }
};
