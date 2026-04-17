<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::firstOrCreate(
            ['slug' => 'volunteer-sinemaku'],
            [
                'position'   => 'Volunteer',
                'tim'        => 'Event & Community',
                'location'   => 'Jakarta, Indonesia',
                'salary'     => 'Unpaid / Experience Based',
                'pengalaman' => 'No experience required, passion for films is a must.',
                'detail'     => 'We are looking for passionate individuals to join our Sinemaku Day event as volunteers. You will help with guest management, back-office support, and on-site logistics.',
                'status'     => 'Open',
                'link'       => '#',
            ]
        );
    }
}
