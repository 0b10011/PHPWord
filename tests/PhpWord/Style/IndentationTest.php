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

namespace PhpOffice\PhpWord\Style;

use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Test class for PhpOffice\PhpWord\Style\Indentation
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Style\Indentation
 */
class IndentationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test get/set
     */
    public function testGetSetProperties()
    {
        $object = new Indentation();
        $properties = array(
            'left'      => array(0, Absolute::from('twip', 10)),
            'right'     => array(0, Absolute::from('twip', 10)),
            'firstLine' => array(null, Absolute::from('twip', 20)),
            'hanging'   => array(null, Absolute::from('twip', 20)),
        );
        foreach ($properties as $property => $value) {
            list($default, $expected) = $value;
            $get = "get{$property}";
            $set = "set{$property}";

            $result = $object->$get();
            if ($expected instanceof Absolute) {
                $result = $result->toInt('twip');
            }
            $this->assertEquals($default, $result); // Default value

            $object->$set($expected);

            $result = $object->$get();
            if ($expected instanceof Absolute) {
                $expected = $expected->toInt('twip');
                $result = $result->toInt('twip');
            }
            $this->assertEquals($expected, $result); // New value
        }
    }
}
