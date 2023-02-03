<?php
declare(strict_types=1);
namespace PragmaGoTech\Interview\LoanFeeCalculator\Application\Command;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator\FeeCalculatorInterface;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\LoanProposal\LoanProposal;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructure;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Rounding\RoundingInterface;
use PragmaGoTech\Interview\LoanFeeCalculator\Infrastructure\Repository\LoanStructureRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'loan:fee:calculate')]
class CalculateLoanFeeCommand extends Command
{
    private $feeCalculator;

    public function __construct(
        FeeCalculatorInterface $feeCalculator)
    {
        $this->feeCalculator = $feeCalculator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('loan:fee:calculate')
            ->setDescription('Calculates the fee for a loan application')
            ->addArgument('amount', InputArgument::REQUIRED, 'Loan amount')
            ->addArgument('term', InputArgument::REQUIRED, 'Loan term (12 or 24 months)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $amount = (float)$input->getArgument('amount');
        $term = (int)$input->getArgument('term');
        $loanProposal = new LoanProposal($term, $amount);

        try {
            $fee = $this->feeCalculator->calculateFee($loanProposal);
            $output->write((string)$fee);
//            $output->writeln(sprintf('The loan fee for an amount of %s PLN with a term of %s months is %s PLN and total cost is %s',
//            $amount, $term, $fee, $amount + $fee));
        } catch (\Exception $e) {
            $output->write((string)$e->getMessage());
        }
        return 0;
    }
}