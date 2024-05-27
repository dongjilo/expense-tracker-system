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
        DB::unprepared("DROP PROCEDURE IF EXISTS GetUserExpensesSummary");
        DB::unprepared("DROP PROCEDURE IF EXISTS GetMonthlyUserExpenses");
        DB::unprepared("DROP PROCEDURE IF EXISTS GetUserCategoryExpenses");

        DB::unprepared("
            CREATE PROCEDURE GetUserExpensesSummary(IN userId INT)
            BEGIN
                SELECT * FROM UserExpensesSummary WHERE user_id = userId LIMIT 1;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE GetMonthlyUserExpenses(IN userId INT, IN year INT)
            BEGIN
                SELECT month, total_expenses
                FROM MonthlyUserExpenses
                WHERE user_id = userId AND year = year
                ORDER BY month;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE GetUserCategoryExpenses(IN userId INT)
            BEGIN
                SELECT category_name, total_expenses
                FROM UserCategoryExpenses
                WHERE user_id = userId;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetUserExpensesSummary");
        DB::unprepared("DROP PROCEDURE IF EXISTS GetMonthlyUserExpenses");
        DB::unprepared("DROP PROCEDURE IF EXISTS GetUserCategoryExpenses");
    }
};
