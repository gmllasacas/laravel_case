<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Carbon\Carbon;

class ShortenedUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        DB::table('shortened_urls')->insert([
            ['route' => 'd90b568f', 'url' => 'https://www.bing.com/', 'title' => null, 'hits' => 50, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['route' => 'd66895de', 'url' => 'https://www.google.com/search?q=test&pws=0&gl=us&gws_rd=cr', 'title' => null, 'hits' => 20, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
