<?php

namespace Database\Seeders;

use App\Models\Interests;
use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interests::factory()->create(['description'=>'Woodworking']);
        Interests::factory()->create(['description'=>'Good Coffee']);
        Interests::factory()->create(['description'=>'Spending time with family']);
    }
}
