<?php
namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('admin12345'),
            'role'     => 'admin',
            'phone'    => '	08979673149',
        ]);

        User::factory()->create([
            'name'     => 'Syechan Mochsin Al-thubaiti',
            'username' => 'seanss',
            'email'    => 'sehanajaoke@gmail.com',
            'password' => bcrypt('password123'),
            'role'     => 'user',
            'phone'    => '	083896535980',
        ]);


        Category::factory()->create([
            'name' => 'Teknologi & Programming',
            'slug' => 'teknologi-programming',
        ]);

        Category::factory()->create([
            'name' => 'Bisnis & Keuangan',
            'slug' => 'bisnis-keuangan',
        ]);

        Category::factory()->create([
            'name' => 'Gaya Hidup & Kesehatan',
            'slug' => 'gaya-hidup-kesehatan',
        ]);

        Category::factory()->create([
            'name' => 'Edukasi & Karier',
            'slug' => 'edukasi-karier',
        ]);

        Category::factory()->create([
            'name' => 'Hiburan & Pop Culture',
            'slug' => 'hiburan-pop-culture',
        ]);

        Category::factory()->create([
            'name' => 'Hobi & Kreativitas',
            'slug' => 'hobi-kreativitas',
        ]);

        Category::factory()->create([
            'name' => 'Review & Rekomendasi',
            'slug' => 'review-rekomendasi',
        ]);
    }
    
}
