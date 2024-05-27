<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW UserCategoryExpenses AS
            SELECT
                e.user_id,
                c.name AS category_name,
                SUM(e.amount) AS total_expenses
            FROM expenses e
            JOIN categories c ON e.category_id = c.id
            GROUP BY e.user_id, c.name
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS UserCategoryExpenses");
    }
};
