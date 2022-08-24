<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        \App\Models\User::factory()->create([
            'name' => 'Lucien',
            'username' => 'lucien',
            'email' => 'zan@gmail.com',
            'password' => Hash::make("12345678"),
            'role' => "0",
            "gender" => "0",
            "isBanned" => "0",
        ]);
        $this->call([
            CategorySeeder::class
        ]);
        $photos = Storage::allFiles("public");
        array_shift($photos);
        Storage::delete($photos);
    }
}
