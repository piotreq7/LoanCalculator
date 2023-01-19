<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use Symfony\Component\Validator\Constraints as Assert;
use PragmaGoTech\Interview\Enums\LoanEnums;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    /** @Assert\Choice(callback = {LoanEnums::class, "getNumberOfMonths"}) */
    private int $term;

    /** @Assert\Range(min = LoanEnums::MIN_LOAN_AMOUNT, max = LoanEnums::MIN_LOAN_AMOUNT) */
    private float $amount;

    public function __construct(int $term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
