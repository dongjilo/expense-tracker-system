<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER after_expense_insert
            AFTER INSERT ON expenses
            FOR EACH ROW
            BEGIN
                DECLARE total DECIMAL(15, 2);
                SELECT COALESCE(SUM(amount), 0) INTO total FROM expenses WHERE user_id = NEW.user_id;
                INSERT INTO user_expenses_totals (user_id, total_expenses, created_at, updated_at)
                VALUES (NEW.user_id, total, NOW(), NOW())
                ON DUPLICATE KEY UPDATE total_expenses = total, updated_at = NOW();
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER after_expense_update
            AFTER UPDATE ON expenses
            FOR EACH ROW
            BEGIN
                DECLARE total DECIMAL(15, 2);
                SELECT COALESCE(SUM(amount), 0) INTO total FROM expenses WHERE user_id = NEW.user_id;
                UPDATE user_expenses_totals
                SET total_expenses = total, updated_at = NOW()
                WHERE user_id = NEW.user_id;
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER after_expense_delete
            AFTER DELETE ON expenses
            FOR EACH ROW
            BEGIN
                DECLARE total DECIMAL(15, 2);
                SELECT COALESCE(SUM(amount), 0) INTO total FROM expenses WHERE user_id = OLD.user_id;
                UPDATE user_expenses_totals
                SET total_expenses = total, updated_at = NOW()
                WHERE user_id = OLD.user_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS after_expense_insert;
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS after_expense_update;
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS after_expense_delete;
        ");
    }
};
