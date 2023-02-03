<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class LoanContext implements Context
{
    protected static $idMap = [];

    /** @var KernelInterface */
    private $kernel;


    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given calculate loan amount :amount in term :term and assign result to :fee with data
     */
    public function calculateLoanAndAssignResultToWithData(float $amount,  int $term, $fee)
    {
        $application = new Application($this->kernel);
        $command = $application->find('loan:fee:calculate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['amount' => $amount, 'term' => $term]);
        $output = $commandTester->getDisplay();
        self::$idMap[$fee] = $output;
    }

    /**
     * @Given the :result is equal :value
     */
    public function theIsEqual($result, $value)
    {
        if((string)self::$idMap[$result] !== (string)$value){
            throw new \RuntimeException('Expected '.(float)$value.' but got '.(float)self::$idMap[$result]);
        }
    }
}
