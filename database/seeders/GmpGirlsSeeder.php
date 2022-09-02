<?php

namespace Database\Seeders;

use App\Models\GmpGirls;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GmpGirlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Zscore_2_to_5 = [];
        $fp = fopen(Storage::path('public/height.txt'), "r");
        //        print_r($fp[0]);
        while (!feof($fp)) {
            $line = fgets($fp);
            $b = explode(" ", $line);
            array_push($Zscore_2_to_5, $b);
        }

        for ($i = 1; $i < count($Zscore_2_to_5); $i++) {
            $c = implode(' ', $Zscore_2_to_5[$i]);
            $d = explode(',', $c);
            GmpGirls::create([
                'age' => $d[0],
                'z3n' => $d[1],
                'z2n' => $d[2],
            ]);
        }
        fclose($fp);
    }
}
