<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use Symfony\Component\Validator\Constraints as Assert;
use PragmaGoTech\Interview\Enums\LoanEnums;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanStructure
{
    public string $currency;

    /** @var LoanBreakPointAndFee[] $loanBreakPointAndFee */
    public array $loanBreakPointAndFee;

    public function __construct(string $currency, array $loanBreakPointAndFee)
    {
        $this->currency = $currency;
        $this->loanBreakPointAndFee = $loanBreakPointAndFee;
    }
}
