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
        DB::unprepared("DROP TRIGGER IF EXISTS before_goal_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS before_goal_update");


        DB::unprepared("
            CREATE TRIGGER before_goal_insert
            BEFORE INSERT ON goals
            FOR EACH ROW
            BEGIN
                IF new.target_amount > 0 THEN
                    SET NEW.progress = (NEW.current_amount / NEW.target_amount) * 100;
                ELSE
                    SET NEW.progress = 0;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER before_goal_update
            BEFORE UPDATE ON goals
            FOR EACH ROW
            BEGIN
                IF new.target_amount > 0 THEN
                    SET NEW.progress = (NEW.current_amount / NEW.target_amount) * 100;
                ELSE
                    SET NEW.progress = 0;
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS before_goal_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS before_goal_update");

    }
};
