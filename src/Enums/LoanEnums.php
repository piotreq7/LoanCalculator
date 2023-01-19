<?php
declare(strict_types=1);

namespace PragmaGoTech\Interview\Enums;

class LoanEnums
{
    const NUMBER_OF_MONTHS = [
        12,
        24
    ];

    const MIN_LOAN_AMOUNT = 1;
    const MAX_LOAN_AMOUNT = 20000;

    public static function getNumberOfMonths(): array
    {
        return array_values(self::NUMBER_OF_MONTHS);
    }

}