<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure;

class FeeStructure implements FeeStructureInterface
{
    public function calculate(float $amount, array $feeStructure): float
    {
        $fee = 0;
        $previousAmount = 0;
        $previousFee = 0;
        if(empty($feeStructure)){
            throw new \RuntimeException('empty structure');
        }
        if($amount>max(array_keys($feeStructure))){
            throw new \RuntimeException('to high amount');
        }
        if($amount<1){
            throw new \RuntimeException('to low amount');
        }

        foreach ($feeStructure as $breakpointAmount => $breakpointFee) {
            if ($amount <= $breakpointAmount) {
                $slope = ($breakpointFee - $previousFee) / ($breakpointAmount - $previousAmount);
                $fee = $previousFee + $slope * ($amount - $previousAmount);
                break;
            }
            $previousAmount = $breakpointAmount;
            $previousFee = $breakpointFee;
        }
        return $fee;
    }
}