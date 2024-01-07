<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\letterType;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::create([
            "name" => "Staff Tata Usaha", 
            "email" => "staff@gmail.com",
            "password" => Hash::make('staffTU'),
            "role" => "staff",
        ]);
        User::create ([
            "name" => "Guru",
            "email" => "guru@gmail.com", 
            "password" => Hash::make('guru'),
            "role" => "guru", 
        ]);

        LetterType::create([
            "name_type" => "rapat_rutin", 
        ]);

        LetterType::create([
            "name_type" => "rapat_guru", 
        ]);

      
    }
}
