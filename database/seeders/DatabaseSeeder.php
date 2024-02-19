<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach ($this->categories() as $category => $subcategories) {
            $parentCategory = ProjectCategory::create(['name' => $category]);

            if (!empty($subcategories)) {
                foreach ($subcategories as $subcategory) {
                    $parentCategory->subcategories()->create(['name' => $subcategory]);
                }
            }
        }
    }

    private function categories(): array
    {
        return [
            'Video Editing' => [
                'Long Form',
                'Short Form',
            ],
            'Programming' => [],
        ];
    }
}
