<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Goal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CurrencyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Currency::factory()->createMany([
            ['name' => 'United States Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'British Pound Sterling', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
        ]);

        // Create a specific user
        $user = User::factory()->create([
            'name' => 'Budget Buddy',
            'email' => 'buddy@e.cc',
            'password' => Hash::make('123')
        ]);

        // Create categories
        Category::factory()->createMany([
            ['name' => 'Work'],
            ['name' => 'School'],
            ['name' => 'Essentials'],
            ['name' => 'Food'],
            ['name' => 'Hobby'],
        ]);

        // Create expenses for the user
        Expense::factory()->createMany([
            ['description' => 'Lunch', 'amount' => 135, 'category_id' => 4, 'date' => '2024-02-02', 'user_id' => $user->id],
            ['description' => 'Dinner', 'amount' => 196, 'category_id' => 4, 'date' => '2024-02-02', 'user_id' => $user->id],
            ['description' => 'In-game cosmetics', 'amount' => 750, 'category_id' => 5, 'date' => '2024-03-26', 'user_id' => $user->id],
            ['description' => 'IT223 project', 'amount' => 1550, 'category_id' => 2, 'date' => '2024-05-27', 'user_id' => $user->id],
            ['description' => 'Work things', 'amount' => 3679, 'category_id' => 1, 'date' => '2024-01-29', 'user_id' => $user->id],
            ['description' => 'Electricity bill', 'amount' => 3998, 'category_id' => 3, 'date' => '2024-01-04', 'user_id' => $user->id],
            ['description' => 'Water bill', 'amount' => 2150, 'category_id' => 3, 'date' => '2024-01-04', 'user_id' => $user->id],
            ['description' => 'Electricity bill', 'amount' => 4089, 'category_id' => 3, 'date' => '2024-02-04', 'user_id' => $user->id],
            ['description' => 'Water bill', 'amount' => 2111, 'category_id' => 3, 'date' => '2024-02-04', 'user_id' => $user->id],
            ['description' => 'Electricity bill', 'amount' => 4110, 'category_id' => 3, 'date' => '2024-03-04', 'user_id' => $user->id],
            ['description' => 'Water bill', 'amount' => 2190, 'category_id' => 3, 'date' => '2024-03-04', 'user_id' => $user->id],
            ['description' => 'Electricity bill', 'amount' => 4898, 'category_id' => 3, 'date' => '2024-04-04', 'user_id' => $user->id],
            ['description' => 'Water bill', 'amount' => 2598, 'category_id' => 3, 'date' => '2024-04-04', 'user_id' => $user->id],
            ['description' => 'Electricity bill', 'amount' => 3998, 'category_id' => 3, 'date' => '2024-05-04', 'user_id' => $user->id],
            ['description' => 'Water bill', 'amount' => 2248, 'category_id' => 3, 'date' => '2024-05-04', 'user_id' => $user->id],
            ['description' => 'Skin care materials', 'amount' => 553, 'category_id' => 3, 'date' => '2024-05-14', 'user_id' => $user->id],
        ]);

        // Create a goal for the user
        Goal::factory()->create([
            'target_amount' => 13000,
            'current_amount' => 3400,
            'target_date' => '2025-12-12',
            'user_id' => $user->id,
        ]);


    }
}
