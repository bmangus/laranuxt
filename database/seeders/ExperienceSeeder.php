<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Experience::factory()->create([
            'company' => 'Oklahoma Heart Hospital',
            'title' => 'Application Developer II',
            'start_date' => '2019-01-15',
            'end_date' => null,
            'description' => 'Work in an Agile environment with a team of 8 developers.
Design, build, and support new applications for clinical and business staff.
Support existing legacy applications.
Communicate with users, attend meetings as needed to support new and existing applications.',
        ]);
        Experience::factory()->create([
            'company' => 'Oklahoma City Web Solutions',
            'title' => 'Owner/Developer',
            'start_date' => '2018-07-01',
            'end_date' => null,
            'description' => 'Communicate with up to 2 clients and 2 contractors weekly during software development process Develop and test applications for desktop, iOS, and the web.
Plan all technology purchases, make recommendations to customers.
Manage all financial aspects including invoicing, billing, and tax preparations.
Provide technical support to customers daily.',
        ]);
        Experience::factory()->create([
            'company' => 'ProData Custom Software',
            'title' => 'Director of Software Development',
            'start_date' => '2009-05-01',
            'end_date' => '2018-07-01',
            'description' => 'Communicated with up to 4 clients weekly during software development process
Managed a team of 2 developers weekly
Trained 1 new hire to certification in FileMaker
Developed and tested over 30 applications for desktop, iOS, and the web annually
Developed 5 web applications and 3 custom modules for integration between FileMaker and RESTful web services
Planned up to 15 technology purchases for my organization quarterly Provided technical support to staff weekly
Installed and deployed up to 5 local area networks annually
Installed and deployed up to 3 servers monthly, both internally and for clients',
        ]);
    }
}
