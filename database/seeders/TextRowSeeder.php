<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TextRow;
use Illuminate\Support\Str;

class TextRowSeeder extends Seeder
{
   public function run(): void
{
    foreach (range(1, 1000) as $i) {
        TextRow::create([
            'text' => 'Random text ' . Str::random(10),
            'status' => $i % 2 == 0 ? 'Allowed' : 'Prohibited',
        ]);
    }
}
}
