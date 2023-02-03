<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\LoanProposal\LoanProposal;

interface FeeCalculatorInterface
{
    /**
     * @return float The calculated total fee.
     */
    public function calculateFee(LoanProposal $application): float;
}
