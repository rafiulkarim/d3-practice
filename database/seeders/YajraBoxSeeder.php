<?php

namespace Database\Seeders;

use App\Models\YajraBox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YajraBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 15000; $i++) {
            $length = 10;
            $user = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,$length);
            $phonel = 10;
            $phone = substr(str_shuffle('0123456789'),1,$phonel);
            YajraBox::create([
               'name' => $user,
                'phone' => $phone
            ]);
        }
    }
}
