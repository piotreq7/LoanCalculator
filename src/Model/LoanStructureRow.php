<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class LoanStructureRow
{
    private float $breakPoint;
    private float $fee;
    private int $numberOfMonths;
    private string $currency;

    public function getBreakPoint(): float
    {
        return $this->breakPoint;
    }

    public function setBreakPoint(float $breakPoint): self
    {
        $this->breakPoint = $breakPoint;
        return $this;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function setFee(float $fee): self
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfMonths(): int
    {
        return $this->numberOfMonths;
    }

    public function setNumberOfMonths(int $numberOfMonths): self
    {
        $this->numberOfMonths = $numberOfMonths;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }
}
