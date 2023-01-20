<?php
declare(strict_types=1);

namespace PragmaGoTech\Interview\Repository;

use PragmaGoTech\Interview\Model\LoanStructureRow;
use Symfony\Component\Filesystem\Filesystem;

class FeeCalculatorRepositoryFromCsv implements FeeCalculatorRepositoryInterface
{
    const PATH = 'LoanStructure/structure.csv';
    /**
     * @var int $numberOfMonths
     * @return LoanStructureRow[]
     */
    public function getStructureByNumberOfMonths(int $numberOfMonths): array
    {
        $data = $this->loadDataFromFile(self::PATH);
        return $this->filterByNumberOfMonths($numberOfMonths, $data);
    }

    public function loadDataFromFile($path): array
    {
        $file = new Filesystem();
        if(!$file->exists($path)){
            throw new \RuntimeException('Cant find file with structure');
        }

        $row = 1;
        $arrayWithData = [];
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 100, ",")) !== FALSE) {
                $row++;
                $arrayWithData[] =
                    (new LoanStructureRow())
                        ->setBreakPoint((int)$data[0])
                        ->setFee((int)$data[1])
                        ->setNumberOfMonths((int)$data[2])
                        ->setCurrency($data[3]);
            }
            fclose($handle);
        }
        return $arrayWithData;
    }

    /**
     * @param int $numberOfMonths
     * @param LoanStructureRow[] $data
     * @return LoanStructureRow[]
     */
    public function filterByNumberOfMonths(int $numberOfMonths, array $data): array
    {
        foreach ($data as $key => $value) {
            if($value->getNumberOfMonths() != $numberOfMonths){
                unset($data[$key]);
            }
        }
        return $data;
    }
}