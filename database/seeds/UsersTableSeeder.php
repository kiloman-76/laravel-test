<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Первый автор',
                'email' => 'admin@test.ru',
                'password' => bcrypt(Str::random(16))
            ],
            [
                'name' => 'Второй автор',
                'email' => 'user@test.ru',
                'password' => bcrypt('123123')
            ],
        ];

        DB::table('users')->insert($data);
    }
}
