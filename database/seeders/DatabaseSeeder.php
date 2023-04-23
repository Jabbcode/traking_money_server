<?php

namespace Database\Seeders;

use App\Models\Type_transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Type_transaction::create(['type' => 'Deposit']);
        Type_transaction::create(['type' => 'Withdrawal']);
    }
}
