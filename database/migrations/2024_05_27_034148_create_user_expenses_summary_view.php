<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS UserExpensesSummary;');

        DB::unprepared('
            CREATE VIEW UserExpensesSummary AS
            SELECT
                users.id as user_id,
                users.name as user_name,
                COUNT(expenses.id) AS expense_count,
                COALESCE(SUM(expenses.amount), 0) AS total_expenses,
                COALESCE(AVG(expenses.amount), 0) AS average_expense,
                COALESCE(MAX(expenses.amount), 0) AS max_expense,
                COALESCE(MIN(expenses.amount), 0) AS min_expense
            FROM
                users
            LEFT JOIN
                expenses ON users.id = expenses.user_id
            GROUP BY
                users.id, users.name;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS UserExpensesSummary;');
    }
};
