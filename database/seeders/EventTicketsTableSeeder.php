<?php

namespace Database\Seeders;

use App\Models\EventTicket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventTicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_tickets')->insert([
            ['event_id' => 1,
            'name' => 'Female',
            'price' => 299,
            'persons' => 0,
            'description' => 'tickets for Female'],
            ['event_id' => 1,
            'name' => 'Male',
            'price' => 399,
            'persons' => 0,
            'description' => 'tickets for Male'],
            ['event_id' => 1,
            'name' => 'Couple',
            'price' => 599,
            'persons' => 0,
            'description' => 'tickets for Couples'],
            ['event_id' => 1,
            'name' => 'Kids',
            'price' => 99,
            'persons' => 0,
            'description' => 'tickets for Kids'],
        ]);
    }
}
