<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $reader = User::factory()->create(
          [
             'name' => 'Reader',
              'email' => 'test@gmail.com',
              'password' => Hash::make('test')
          ]);
      $reader->assignRole('reader');


        $moderator = User::factory()->create(
            [
                'name' => 'Moderator',
                'email' => 'Moderatort@gmail.com',
                'password' => Hash::make('mod')
            ]);
        $moderator->assignRole('moderator');

        $admin= User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin')
            ]);
        $admin->assignRole('admin');
    }


}
