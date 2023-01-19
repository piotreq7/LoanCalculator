<?php
declare(strict_types=1);

namespace PragmaGoTech\Interview\Repository;

interface FeeCalculatorRepositoryInterface
{
    public function getStructureByNumberOfMonths(int $numberOfMonths): array;
}