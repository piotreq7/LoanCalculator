<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class LoanBreakPointAndFee
{
    public int $breakPoint;
    public int $fee;

    public function __construct(int $breakPoint, int $fee)
    {
        $this->breakPoint = $breakPoint;
        $this->fee = $fee;
    }
}
