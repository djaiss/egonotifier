<?php

namespace App\Helpers;

use App\Models\Check;

class LevelHelper
{
    /**
     * Return the level corresponding to the given value.
     *
     * @param integer $currentValue
     * @return integer
     */
    public static function checkLevel(int $currentValue) : int
    {
        $levels = [
            95 => 200000,
            94 => 195000,
            93 => 190000,
            92 => 185000,
            91 => 180000,
            90 => 175000,
            89 => 170000,
            88 => 165000,
            87 => 160000,
            86 => 155000,
            85 => 150000,
            84 => 145000,
            83 => 140000,
            82 => 135000,
            81 => 130000,
            80 => 125000,
            79 => 120000,
            78 => 115000,
            77 => 110000,
            76 => 105000,
            75 => 100000,
            74 => 95000,
            73 => 90000,
            72 => 85000,
            71 => 80000,
            70 => 75000,
            69 => 70000,
            68 => 65000,
            67 => 60000,
            66 => 55000,
            65 => 50000,
            64 => 45000,
            63 => 40000,
            62 => 35000,
            61 => 30000,
            60 => 29000,
            59 => 28000,
            58 => 27000,
            57 => 26000,
            56 => 25000,
            55 => 24000,
            54 => 23000,
            53 => 22000,
            52 => 21000,
            51 => 20000,
            50 => 19000,
            49 => 18000,
            48 => 17000,
            47 => 16000,
            46 => 15000,
            45 => 14000,
            44 => 13000,
            43 => 12000,
            42 => 11000,
            41 => 10000,
            40 => 9000,
            39 => 8000,
            38 => 7000,
            37 => 6000,
            36 => 5000,
            35 => 4500,
            34 => 4000,
            33 => 3500,
            32 => 3000,
            31 => 2500,
            30 => 2000,
            29 => 1500,
            28 => 1000,
            27 => 900,
            26 => 800,
            25 => 700,
            24 => 600,
            23 => 500,
            22 => 400,
            21 => 300,
            20 => 200,
            19 => 100,
            18 => 90,
            17 => 80,
            16 => 70,
            15 => 60,
            14 => 50,
            13 => 40,
            12 => 30,
            11 => 20,
            10 => 10,
            9  => 9,
            8  => 8,
            7  => 7,
            6  => 6,
            5  => 5,
            4  => 4,
            3  => 3,
            2  => 2,
            1  => 1,
        ];

        foreach ($levels as $key => $value) {
            if ($value < $currentValue) {
                return $key;
            }
        }

        return 0;
    }

    public static function process(Check $check) : array
    {
        $level = [];
        if ($check->value < 10) {
            $level = [
                'lower_bracket' => 1,
                'upper_bracket' => 10,
                'current_value' => $check->value,
            ];
        }

        if ($check->value >= 10 && $check->value < 20) {
            $level = [
                'lower_bracket' => 10,
                'upper_bracket' => 20,
                'current_value' => $check->value,
            ];
        }

        if ($check->value >= 20 && $check->value < 30) {
            $level = [
                'lower_bracket' => 20,
                'upper_bracket' => 30,
                'current_value' => $check->value,
            ];
        }

        if ($check->value >= 30 && $check->value < 40) {
            $level = [
                'lower_bracket' => 30,
                'upper_bracket' => 40,
                'current_value' => $check->value,
            ];
        }

        return $level;
    }
}
