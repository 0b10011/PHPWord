<?php
declare(strict_types=1);
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\Word2007\Style;

use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * @coversDefaultClass \PhpOffice\PhpWord\Writer\Word2007\Style\MarginBorder
 * @runTestsInSeparateProcesses
 */
class MarginBorderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test write styles
     */
    public function testSetSizes()
    {
        $xmlWriter = new XMLWriter();
        $marginBorder = new MarginBorder($xmlWriter);
        $marginBorder->setSizes(array(
            Absolute::from('twip', 1),
            Absolute::from('twip', 5),
            Absolute::from('twip', 3),
            Absolute::from('twip', 0),
        ));
        $marginBorder->write();
        $this->assertEquals("<w:top w:w=\"1\" w:type=\"dxa\"/>\n<w:left w:w=\"5\" w:type=\"dxa\"/>\n<w:right w:w=\"3\" w:type=\"dxa\"/>\n<w:bottom w:type=\"nil\"/>\n", $xmlWriter->getData());
    }

    /**
     * @depends testSetSizes
     * @expectedException \PhpOffice\PhpWord\Exception\Exception
     * @expectedExceptionMessage An array of `PhpOffice\PhpWord\Style\Lengths\Absolute` must be provided. `integer` provided for array[1]
     */
    public function testSetSizesInvalid()
    {
        $marginBorder = new MarginBorder(new XMLWriter());
        $marginBorder->setSizes(array(
            Absolute::from('pt', 1),
            5,
        ));
    }
}
