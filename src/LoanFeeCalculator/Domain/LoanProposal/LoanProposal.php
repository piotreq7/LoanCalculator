<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\LoanProposal;

class LoanProposal
{
    private $term;

    private $amount;

    public function __construct(int $term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}