<?php

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Database;

use PhpOffice\PhpSpreadsheet\Calculation\Database\DCountA;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PHPUnit\Framework\TestCase;

class DCountATest extends TestCase
{
    protected function setUp(): void
    {
        Functions::setCompatibilityMode(Functions::COMPATIBILITY_EXCEL);
    }

    /**
     * @dataProvider providerDCountA
     *
     * @param mixed $expectedResult
     */
    public function testDCountA($expectedResult, $database, $field, $criteria)
    {
        $result = DCountA::evaluate($database, $field, $criteria);
        self::assertSame($expectedResult, $result);
    }

    protected function database()
    {
        return [
            ['Tree', 'Height', 'Age', 'Yield', 'Profit'],
            ['Apple', 18, 20, 14, 105],
            ['Pear', 12, 12, 10, 96],
            ['Cherry', 13, 14, 9, 105],
            ['Apple', 14, 15, 10, 75],
            ['Pear', 9, 8, 8, 76.8],
            ['Apple', 8, 9, 6, 45],
        ];
    }

    public function providerDCountA()
    {
        return [
            [
                1,
                $this->database(),
                'Profit',
                [
                    ['Tree', 'Height', 'Height'],
                    ['=Apple', '>10', '<16'],
                ],
            ],
        ];
    }
}
