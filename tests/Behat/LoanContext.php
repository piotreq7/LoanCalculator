<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class LoanContext implements Context
{
    protected static $idMap = [];

    /** @var KernelInterface */
    private $kernel;

    /** @var FeeCalculatorService */
    private $feeCalculatorService;

//    /** @var Response|null */
//    private $response;

    public function __construct(KernelInterface $kernel, FeeCalculatorService $feeCalculatorService)
    {
        $this->kernel = $kernel;
        $this->feeCalculatorService = $feeCalculatorService;
    }

//    /**
//     * @When a demo scenario sends a request to :path
//     */
//    public function aDemoScenarioSendsARequestTo(string $path): void
//    {
//        $this->response = $this->kernel->handle(Request::create($path, 'GET'));
//    }
//
//    /**
//     * @Then the response should be received
//     */
//    public function theResponseShouldBeReceived(): void
//    {
//        if ($this->response === null) {
//            throw new \RuntimeException('No response received');
//        }
//    }

    /**
     * @Given calculate loan and assign result to :result with data:
     */
    public function calculateLoanAndAssignResultToWithData($result, TableNode $table)
    {
        $data = $table->getRowsHash();
        /** @var FeeCalculatorService $test */
        self::$idMap[$result] = $this->feeCalculatorService->calculate(new LoanProposal((int)$data['numberOfMonths'],(int)$data['loanAmount']));
    }

    /**
     * @Given the :result is equal :value
     */
    public function theIsEqual($result, $value)
    {
        if(self::$idMap[$result] !== (float)$value){
            throw new \RuntimeException('Incorect result');
        }    }
}
