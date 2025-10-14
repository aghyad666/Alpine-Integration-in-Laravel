<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define counts.
        $parentsCount = 5;
        $childrenCount = 20;

        // Make root parents for both types.
        $incomeParents = Category::factory()->count($parentsCount)->rootCategory()->type('income')->create();
        $expenseParents = Category::factory()->count($parentsCount)->rootCategory()->type('expense')->create();

        // Create children for income/expense.
        // Every child gets random existing parent.
        Category::factory()->count($childrenCount)
            ->type('income')
            ->state(function () use ($incomeParents) {
                $parent = $incomeParents->random();
                return [
                    'parent_id' => $parent->id,
                ];
            })
            ->create();

        Category::factory()->count($childrenCount)
            ->type('expense')
            ->state(function () use ($expenseParents) {
                $parent = $expenseParents->random();
                return [
                    'parent_id' => $parent->id,
                ];
            })
            ->create();
    }
}
