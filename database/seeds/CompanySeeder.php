<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use Faker\Factory;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate Employee table truncate before seeding
        Company::truncate();
        
        $faker = Factory::create();
        
        foreach (range(1,10) as $index) {
            Company::create([
                'name' => $faker->catchPhrase,
                'email' => $faker->unique()->companyEmail,
                'website' => $faker->unique()->domainName,
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
            ]);
        }
    }
}