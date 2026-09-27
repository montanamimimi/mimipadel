<?php

namespace App\Services;

class EloRatingService
{
    public function calculate(
        int $ratingA,
        int $ratingB,
        int $ratingC,
        int $ratingD,      
        int $scoreA,
        int $scoreB,
        )
    {
        $teamA = $this->getTeamScore($ratingA, $ratingB);
        $teamB = $this->getTeamScore($ratingC, $ratingD);

        $expected = $this->getExpectedScore($teamA, $teamB);

        $k = 12;

        if ($scoreA > $scoreB) {
            $eloK = 1;
        } else if ($scoreA < $scoreB) {
            $eloK = 0;
        } else {
            $eloK = 0.5;
        }

        $eloChange = $k * ($eloK - $expected);
        $scoreFactor = abs($scoreA - $scoreB)/($scoreA + $scoreB);

        $multiplier = 1 + $scoreFactor;
        $change = round($eloChange * $multiplier);

        return $change;
    }

    public function getExpectedScore(int $a, int $b) {

        $exponent = ($b - $a)/400;
        $pow = pow(10, $exponent);
        $expected = 1/(1+$pow);

        return round($expected, 4);

    }

    public function getTeamScore(int $a, int $b) {
        return round(($a + $b)/2);
    }    
}