<?php

namespace App\Http\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ChunkReadFilter implements IReadFilter {
    public function readCell($columnAddress, $row, $worksheetName = '') {
        return $row <= 20;
    }
}

class HeaderRow {
    public function detectHeaderRow($fullPath, $extension, $maxLines = 20) {
        $expectedColumns = ['RptDt', 'TckrSymb', 'ISIN', 'CrpnNm'];

        if ($extension === 'csv') {
            if (($handle = fopen($fullPath, "r")) !== FALSE) {
                $firstLine = fgets($handle);
                $separator = (strpos($firstLine, ';') !== false) ? ';' : ',';

                rewind($handle);
                $rowCounter = 1;

                while (($rowData = fgetcsv($handle, 0, $separator)) !== FALSE && $rowCounter <= $maxLines) {
                    $rowData = array_map('trim', $rowData);
                    if ($this->hasExpectedColumns($rowData, $expectedColumns)) {
                        fclose($handle);
                        return $rowCounter;
                    }
                    $rowCounter++;
                }

                fclose($handle);
            }
        }else {
            $reader = IOFactory::createReaderForFile($fullPath);
            $reader->setReadDataOnly(true);
            $reader->setReadFilter(new ChunkReadFilter());

            $spreadsheet = $reader->load($fullPath);
            $worksheet = $spreadsheet->getActiveSheet();

            for ($row = 1; $row <= $maxLines; $row++) {
                $rowData = [];
                foreach ($worksheet->getRowIterator($row, $row)->current()->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }

                if ($this->hasExpectedColumns($rowData, $expectedColumns)) {
                    return $row;
                }
            }
        }

        return 1;
    }

    private function hasExpectedColumns($rowData, $expectedColumns) {
        $matches = 0;
        foreach ($expectedColumns as $expected) {
            if (in_array($expected, $rowData)) {
                $matches++;
            }
        }

        return $matches >= 2;
    }
}
