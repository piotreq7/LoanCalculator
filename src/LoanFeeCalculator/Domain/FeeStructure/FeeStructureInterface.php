<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure;

interface FeeStructureInterface
{
    public function calculate(float $amount, array $feeStructure): float;
}