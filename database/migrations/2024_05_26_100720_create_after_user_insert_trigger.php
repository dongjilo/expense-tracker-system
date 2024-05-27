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
        DB::unprepared('
            CREATE TRIGGER after_user_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                DECLARE default_currency_id INT;

                SELECT id INTO default_currency_id FROM currencies WHERE code = "PHP";

                INSERT INTO settings(user_id, currency_id, created_at, updated_at)
                VALUES (NEW.id, default_currency_id, NOW(), NOW());
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_user_insert');
    }
};
