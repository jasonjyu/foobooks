<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        /*
        Because Books will be associated with Authors,
        we need to seed Authors first
        */
        $this->call(AuthorsTableSeeder::class);
        $this->call(BooksTableSeeder::class);

        Model::reguard();
    }
}
