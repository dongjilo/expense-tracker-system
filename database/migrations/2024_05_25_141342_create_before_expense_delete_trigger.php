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
        DB::unprepared("
            CREATE TRIGGER before_expenses_delete
            BEFORE DELETE ON expenses
            FOR EACH ROW
            BEGIN
                INSERT INTO expense_deletion_logs (expense_id, user_id, category_id, amount, description, deleted_at)
                VALUES (OLD.id, OLD.user_id, OLD.category_id, OLD.amount, OLD.description, NOW());
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS before_expenses_delete
        ");
    }
};
