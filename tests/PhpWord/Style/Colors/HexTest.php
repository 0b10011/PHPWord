<?php
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

namespace PhpOffice\PhpWord\Style\Colors;

/**
 * Test class for PhpOffice\PhpWord\Shared\Converter
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Shared\Converter
 */
class HexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test htmlToRGB()
     * @expectedException \Exception
     * @expectedExceptionMessage Hex value must match `([0-9a-f]{3}){1,2}`. `0F9D` provided
     */
    public function testHexToRgb()
    {
        // Prepare test values [ original, expected ]
        $values = array();
        $values[] = array('FF99DD', 'FF99DD', array(255, 153, 221)); // 6 characters
        $values[] = array('F9D', 'FF99DD', array(255, 153, 221)); // 3 characters
        $values[] = array('0F9D', null, null); // 4 characters
        // Conduct test
        foreach ($values as $value) {
            $result = new Hex($value[0]);
            $this->assertEquals($value[1], $result->toHex());
            $this->assertEquals('#' . $value[1], $result->toHex(true));
            $this->assertEquals($value[2], $result->toRgb());
        }
    }
}
