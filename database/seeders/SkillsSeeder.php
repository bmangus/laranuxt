<?php

namespace Database\Seeders;

use App\Models\Skills;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skills::factory()->create(['description' => 'PHP', 'years_experience' => '10+']);
        Skills::factory()->create(['description' => 'MySQL', 'years_experience' => '10+']);
        Skills::factory()->create(['description' => 'Laravel and Codeigniter frameworks', 'years_experience' => '7']);
        Skills::factory()->create(['description' => 'Javascript/Typescript', 'years_experience' => '7']);
        Skills::factory()->create(['description' => 'React (typescript)', 'years_experience' => '5']);
        Skills::factory()->create(['description' => 'Vue.js (typescript)', 'years_experience' => '5']);
        Skills::factory()->create(['description' => 'jQuery (javascript)', 'years_experience' => '7']);
    }
}
