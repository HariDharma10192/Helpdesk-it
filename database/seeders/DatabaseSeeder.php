<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'role' => 'Admin'],
            ['id' => 2, 'role' => 'User'],
            ['id' => 3, 'role' => 'Department']
            // Add more roles as needed
        ];

        // Insert data into the 'roles' table
        DB::table('roles')->insert($roles);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role_id' => 1, // Use the appropriate role_id
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed user with role 2
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('user1'),
            'role_id' => 2, // Use the appropriate role_id
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'dept',
            'email' => 'dept@gmail.com',
            'password' => Hash::make('dept'),
            'role_id' => 3, // Use the appropriate role_id
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $faker = Faker::create();

        $user1Id = DB::table('users')->where('name', 'user1')->value('id');

        // Generate 20 random complaints for user1
        for ($i = 0; $i < 20; $i++) {
            DB::table('complaints')->insert([
                'username' => 'user1',
                'department_name' => 'Accounting',
                'department_destination' => 'IT',
                'no_workorder' => $faker->unique()->numberBetween(1000, 9999),
                'complaint_date' => $faker->date,
                'solved_date' => $faker->optional()->date,
                'complaint_type' => $faker->randomElement(['ringan', 'sedang', 'berat']),
                'description' => $faker->paragraph,
                'photo' => null,
                'status' => $faker->randomElement(['dikirim', 'proses', 'done']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
