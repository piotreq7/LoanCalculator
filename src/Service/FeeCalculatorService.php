<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\FeeCalculatorInterface;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\LoanStructureRow;
use PragmaGoTech\Interview\Repository\FeeCalculatorRepositoryFromCsv;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FeeCalculatorService implements FeeCalculatorInterface
{
    const ROUND_TO = 5;
    private FeeCalculatorRepositoryFromCsv $feeCalculatorRepository;
    private ValidatorInterface $validator;

    public function __construct(FeeCalculatorRepositoryFromCsv $feeCalculatorRepository, ValidatorInterface $validator)
    {
        $this->feeCalculatorRepository = $feeCalculatorRepository;
        $this->validator = $validator;
    }

    /**
     * @param LoanProposal $application
     * @return float
     * @throws
     */
    public function calculate(LoanProposal $application): float
    {

        $errors = $this->validator->validate($application);
        if (count($errors)>0) {
            throw $errors;
            //TODO fix this validation
        }
        $data = $this->feeCalculatorRepository->getStructureByNumberOfMonths($application->term());
        $closestUpperBreakPoint = $this->getClosestUpperBreakPoint($application->amount(),$data);
        $closestLowerBreakPoint = $this->getClosestLowerBreakPoint($application->amount(),$data);
        if($closestUpperBreakPoint !== $closestLowerBreakPoint){
            $betweenZeroAndOne = ($application->amount() - $closestLowerBreakPoint->getBreakPoint())
                /
                ($closestUpperBreakPoint->getBreakPoint() - $closestLowerBreakPoint->getBreakPoint());

            $fee =  $closestLowerBreakPoint->getFee() * ( 1 - $betweenZeroAndOne) + $closestUpperBreakPoint->getFee() * $betweenZeroAndOne;
        } else {
            $fee = $closestUpperBreakPoint->getFee();
        }

         $fee = $this->roundFee($application->amount(), $fee, self::ROUND_TO);
         return round($fee,2);
    }

    public function getClosestUpperBreakPoint(float $amount, $data): LoanStructureRow
    {
        $gap = null;
        $closestBreakPoint = null;
        /** @var LoanStructureRow $value */
        foreach ($data as $value){
            if($value->getBreakPoint() >= $amount ){
                if($gap == null){
                    $gap = $value->getBreakPoint();
                }
                if($value->getBreakPoint() - $amount < $gap){
                    $gap = $value->getBreakPoint() - $amount;
                    $closestBreakPoint = $value;
                }
            }
        }
        return $closestBreakPoint;
    }
    public function getClosestLowerBreakPoint(float $amount, $data): LoanStructureRow
    {
        $gap = null;
        $closestBreakPoint = null;
        /** @var LoanStructureRow $value */
        foreach ($data as $value){
            if($value->getBreakPoint() <= $amount ){
                if($gap == null){
                    $gap = $amount - $value->getBreakPoint();
                }
                if($amount - $value->getBreakPoint() < $gap){
                    $gap = $amount - $value->getBreakPoint();
                    $closestBreakPoint = $value;
                }
            }
        }
        if($closestBreakPoint == null){
            $closestBreakPoint = (new LoanStructureRow)->setBreakPoint(0)->setFee(0);
        }
        return $closestBreakPoint;
    }
    public function roundFee( float $amount, float $fee, $roundTo): float
    {
        $sum = $amount + $fee;
        $difference = fmod($sum , $roundTo);
        if($difference == 0.0){
            return $fee;
        }
        $fee =  ceil($sum / 5) * 5 - $amount;
        return $fee;
    }
}