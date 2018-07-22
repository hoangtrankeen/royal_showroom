<?php

use Illuminate\Database\Seeder;


class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\User::create(array(
            'name'     => 'Chan Chan Man',
            'email'    => 'customer@gmail.com',
            'password' => Hash::make('Hoangbboy1'),
        ));

        \App\Model\Admin::create(array(
            'name'     => 'Chan Chan Man',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('Hoangbboy1'),
        ));
    }
}
