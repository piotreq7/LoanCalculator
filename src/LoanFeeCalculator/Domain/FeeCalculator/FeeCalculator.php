<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\LoanProposal\LoanProposal;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructureInterface;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Rounding\RoundingInterface;
use PragmaGoTech\Interview\LoanFeeCalculator\Infrastructure\Repository\LoanStructureRepositoryInterface;

class FeeCalculator implements FeeCalculatorInterface
{
    private FeeStructureInterface $feeStructure;
    private RoundingInterface $rounding;
    private LoanStructureRepositoryInterface $loanStructureRepository;

    public function __construct(
        FeeStructureInterface $feeStructure,
        RoundingInterface $rounding,
        LoanStructureRepositoryInterface $loanStructureRepository
    ) {
        $this->feeStructure = $feeStructure;
        $this->rounding = $rounding;
        $this->loanStructureRepository = $loanStructureRepository;
    }

    public function calculateFee(LoanProposal $loanProposal): float
    {
        $amount = $loanProposal->getAmount();
        $term = $loanProposal->getTerm();
        $loanStructure = $this->loanStructureRepository->getStructureByNumberOfMonths($term);
        $fee = $this->feeStructure->calculate($amount, $loanStructure);
        return $this->rounding->round($amount, $fee);
    }
}