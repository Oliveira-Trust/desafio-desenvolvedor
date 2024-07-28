<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fee::insert(
            [
                [
                    "name" => "Basic Fee",
                    "rate" => "1.00",
                    "applied_when_lower" => "100000.00"
                ],
                [
                    "name" => "Lower than 3000",
                    "rate" => "2.00",
                    "applied_when_lower" => "3000.00"
                ]
            ]
        );
    }
}
