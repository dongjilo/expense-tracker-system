<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetMonthlyExpensesProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('DROP PROCEDURE IF EXISTS GetMonthlyExpenses');

        DB::unprepared('
            CREATE PROCEDURE GetMonthlyExpenses(IN userId INT, IN year INT, IN month INT)
            BEGIN
                SELECT COALESCE(SUM(amount), 0) AS total_expenses
                FROM expenses
                WHERE user_id = userId
                AND YEAR(date) = year
                AND MONTH(date) = month;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetMonthlyExpenses');
    }
}
