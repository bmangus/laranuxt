<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Interests;
use App\Models\Skills;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(1)
            ->create();

    }
}
