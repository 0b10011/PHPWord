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

namespace PhpOffice\PhpWord\Style;

use PhpOffice\PhpWord\SimpleType\VerticalJc;
use PhpOffice\PhpWord\Style\Colors\AbstractColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Test class for PhpOffice\PhpWord\Style\Cell
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Style\Cell
 * @runTestsInSeparateProcesses
 */
class CellTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test setting style with normal value
     */
    public function testSetGetNormal()
    {
        $object = new Cell();

        $attributes = array(
            'valign'            => VerticalJc::TOP,
            'textDirection'     => Cell::TEXT_DIR_BTLR,
            'bgColor'           => new Hex('FFFF00'),
            'borderTopSize'     => Absolute::from('eop', 120),
            'borderTopColor'    => new Hex('FFFF00'),
            'borderLeftSize'    => Absolute::from('eop', 120),
            'borderLeftColor'   => new Hex('FFFF00'),
            'borderRightSize'   => Absolute::from('eop', 120),
            'borderRightColor'  => new Hex('FFFF00'),
            'borderBottomSize'  => Absolute::from('eop', 120),
            'borderBottomColor' => new Hex('FFFF00'),
            'gridSpan'          => 2,
            'vMerge'            => Cell::VMERGE_RESTART,
        );
        foreach ($attributes as $key => $value) {
            $get = "get$key";
            $result = $object->$get();
            if ($result instanceof AbstractColor) {
                $result = $result->toHex();
            } elseif ($result instanceof Absolute) {
                $result = $result->toInt('eop');
            }

            $this->assertNull($result);

            $set = "set{$key}";
            $object->$set($value);

            $get = "get$key";
            $result = $object->$get();
            if ($result instanceof AbstractColor) {
                $result = $result->toHex();
                $value = $value->toHex();
            } elseif ($result instanceof Absolute) {
                $result = $result->toInt('eop');
                $value = $value->toInt('eop');
            }

            $this->assertEquals($value, $result);
        }
    }

    /**
     * Test border color
     */
    public function testBorderColor()
    {
        $object = new Cell();

        $value = 'FF0000';

        $object->setStyleValue('borderColor', new Hex($value));
        $expected = array($value, $value, $value, $value);
        $this->assertEquals($expected, array_map(function ($value) {
            return $value->toHex();
        }, $object->getBorderColor()));
    }

    /**
     * Test border size
     */
    public function testBorderSize()
    {
        $object = new Cell();

        $value = 120;
        $expected = array($value, $value, $value, $value);
        $object->setStyleValue('borderSize', Absolute::from('twip', $value));
        $this->assertEquals($expected, array_map(function ($value) {
            return $value->toInt('twip');
        }, $object->getBorderSize()));
    }
}
