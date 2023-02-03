<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\Rounding;

interface RoundingInterface
{
    public function round(float $amount, float $fee): float;
}