<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class LoanContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
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
     * @Given calculate loan with data:
     */
    public function calculateLoanWithData(TableNode $table)
    {
    }

}