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
        // User::factory(10)->create();



        Currency::create([
            'name' => 'United States Dollar',
            'code' => 'USD',
            'symbol' => '$',
        ]);

        Currency::create([
            'name' => 'Philippine Peso',
            'code' => 'PHP',
            'symbol' => '₱',
        ]);

        Currency::create([
            'name' => 'Euro',
            'code' => 'EUR',
            'symbol' => '€',
        ]);

        Currency::create([
            'name' => 'British Pound Sterling',
            'code' => 'GBP',
            'symbol' => '£',
        ]);

        Currency::create([
            'name' => 'Japanese Yen',
            'code' => 'JPY',
            'symbol' => '¥',
        ]);


        User::factory()->create([
            'name' => 'Budget Buddy',
            'email' => 'buddy@e.cc',
            'password' => Hash::make('123')
        ]);

        Category::create([
            'name' => 'Work'
        ]);

        Category::create([
            'name' => 'School'
        ]);

        Category::create([
            'name' => 'Essentials'
        ]);

        Category::create([
            'name' => 'Food'
        ]);

        Category::create([
            'name' => 'Hobby'
        ]);

        Expense::create([
           'description' => 'Lunch',
           'amount'  => '135',
           'category_id' => '4',
           'date' => '2024-02-02',
           'user_id' => '1',
        ]);

        Expense::create([
            'description' => 'Dinner',
            'amount'  => '196',
            'category_id' => '4',
            'date' => '2024-02-02',
            'user_id' => '1',
        ]);

        Expense::create([
            'description' => 'In-game cosmetics',
            'amount'  => '750',
            'category_id' => '5',
            'date' => '2024-03-26',
            'user_id' => '1',
        ]);

        Expense::create([
            'description' => 'Electricity bill',
            'amount'  => '4319',
            'category_id' => '3',
            'date' => '2024-04-04',
            'user_id' => '1',
        ]);

        Expense::create([
            'description' => 'Water bill',
            'amount'  => '2396',
            'category_id' => '3',
            'date' => '2024-04-04',
            'user_id' => '1',
        ]);

        Expense::create([
            'description' => 'Skin care materials',
            'amount'  => '553',
            'category_id' => '3',
            'date' => '2024-05-14',
            'user_id' => '1',
        ]);

        Goal::create([
            'target_amount' => '13000',
            'current_amount' => '3400',
            'target_date' => '2025-12-12',
            'user_id' => '1',
        ]);
    }
}
