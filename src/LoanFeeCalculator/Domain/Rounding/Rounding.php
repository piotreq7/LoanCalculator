<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\Rounding;

class Rounding implements RoundingInterface
{
    public function round(float $amount, float $fee): float
    {
        $sumRounded =  ceil(($amount + $fee) / 5) * 5;
        return $sumRounded - $amount;
    }
}