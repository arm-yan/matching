<?php

declare(strict_types=1);

namespace Armyan\Matching;

use Armyan\Matching\Exception\FileNotFoundException;
use Armyan\Matching\Exception\InvalidFileFormatException;

class Parser
{
    /**
     * Parse CSV to associative array and remove header
     *
     * @param array $csv
     * @return array
     * @throws InvalidFileFormatException
     */
    public function parseCsvArray(array $csv) : array
    {
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });

        // Removing headers
        array_shift($csv);

        if(empty($csv)) {
            throw new InvalidFileFormatException('Invalid file format.');
        }

        if( count($csv)%2 != 0) {
            $csv = $this->addEmptyRowInCsv($csv);
        }

        return $csv;
    }

    /**
     * Adds new empty array to csv with its structure
     *
     * @param array $csv
     * @return array
     */
    protected function addEmptyRowInCsv(array $csv) : array
    {
        $newRow = [];
        foreach ($csv[0] as $key => $value) {
            $newRow[$key] = null;
        }
        $csv[] = $newRow;
        return $csv;
    }

    /**
     * Convert CSV to array
     *
     * @param string $filePath
     * @return array
     * @throws FileNotFoundException
     */
    public function convertCsvToArray(string $filePath) : array
    {
        try {
            return array_map('str_getcsv', file($filePath));
        } catch (FileNotFoundException $exception) {
            throw new FileNotFoundException('File not found.');
        }

    }
}
