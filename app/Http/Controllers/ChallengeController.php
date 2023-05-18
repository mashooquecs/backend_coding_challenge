<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ChallengeController extends Controller
{
    public function challengeTwo()
    {
        $dupArr = array(2, 3, 1, 2, 3);
        $result = array();
        $count  = array();

        // Count the occurrences of each element
        foreach ($dupArr as $num) {
            if (!isset($count[$num])) {
                $count[$num] = 1;
            } else {
                $count[$num]++;
            }
        }

        // Find the elements occurring more than once
        foreach ($count as $num => $occurrences) {
            if ($occurrences > 1) {
                $result[] = $num;
            }
        }

        return "Duplicates: " . implode(' ', $result);
    }
}
