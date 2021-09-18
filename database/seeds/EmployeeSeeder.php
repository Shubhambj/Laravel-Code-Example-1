<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate Employee table truncate before seeding
        Employee::truncate();
        
        $faker = Factory::create();
        
        foreach (range(1,50) as $index) {
            Employee::create([
                'first_name' => $faker->firstname,
                'last_name' => $faker->lastname,
                'email' => $faker->unique()->safeEmail,
                'company_id' => $faker->numberBetween($min = 1, $max = 10),
                'phone' => $faker->numerify('##########'),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
            ]);
        }
    }
}