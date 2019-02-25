<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Models\Departamento::class, 15)->create();
        factory(App\Models\Usuario::class, 2)->create();
        factory(App\Models\Ticket::class, 20)->create();
    }
}
