<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Infrastructure\Repository;

interface LoanStructureRepositoryInterface
{
    public function getStructureByNumberOfMonths(int $term): array;
}