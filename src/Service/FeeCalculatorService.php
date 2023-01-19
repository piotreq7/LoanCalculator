<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\FeeCalculatorInterface;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Repository\FeeCalculatorRepositoryFromCsv;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FeeCalculatorService implements FeeCalculatorInterface
{
    private FeeCalculatorRepositoryFromCsv $feeCalculatorRepository;
    private ValidatorInterface $validator;

    public function __construct(FeeCalculatorRepositoryFromCsv $feeCalculatorRepository, ValidatorInterface $validator)
    {
        $this->feeCalculatorRepository = $feeCalculatorRepository;
        $this->validator = $validator;
    }

    /**
     * @param LoanProposal $application
     * @return float
     * @throws
     */
    public function calculate(LoanProposal $application): float
    {
        $errors = $this->validator->validate($application);
        if (count($errors)>0) {
            throw $errors;
        }
        $test = $this->feeCalculatorRepository->getStructureByNumberOfMonths(12);
        return 0.0;
    }
}