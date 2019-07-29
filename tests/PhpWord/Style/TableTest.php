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

use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Colors\BasicColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;
use PhpOffice\PhpWord\Style\Lengths\Auto;
use PhpOffice\PhpWord\Style\Lengths\Percent;

/**
 * Test class for PhpOffice\PhpWord\Style\Table
 *
 * @runTestsInSeparateProcesses
 */
class TableTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test class construction
     *
     * There are 3 variables for class constructor:
     * - $styleTable: Define table styles
     * - $styleFirstRow: Define style for the first row
     */
    public function testConstruct()
    {
        $styleTable = array('bgColor' => new Hex('FF0000'));
        $styleFirstRow = array('borderBottomSize' => Absolute::from('eop', 3));

        $object = new Table($styleTable, $styleFirstRow);
        $this->assertEquals('FF0000', $object->getBgColor()->toHex());

        $firstRow = $object->getFirstRow();
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\Table', $firstRow);
        $this->assertEquals(3, $firstRow->getBorderBottomSize()->toInt('eop'));
    }

    /**
     * Test default values when passing no style
     */
    public function testDefaultValues()
    {
        $object = new Table();

        $this->assertNull($object->getBgColor()->toHex());
        $this->assertEquals(Table::LAYOUT_AUTO, $object->getLayout());
        $this->assertInstanceOf(Auto::class, $object->getIndent());
    }

    /**
     * Test setting style with normal value
     */
    public function testSetGetNormal()
    {
        $object = new Table();

        $attributes = array(
            'bgColor'            => new Hex('FF0000'),
            'borderTopSize'      => Absolute::from('eop', 4),
            'borderTopColor'     => new Hex('FF0000'),
            'borderLeftSize'     => Absolute::from('eop', 4),
            'borderLeftColor'    => new Hex('FF0000'),
            'borderRightSize'    => Absolute::from('eop', 4),
            'borderRightColor'   => new Hex('FF0000'),
            'borderBottomSize'   => Absolute::from('eop', 4),
            'borderBottomColor'  => new Hex('FF0000'),
            'borderInsideHSize'  => Absolute::from('eop', 4),
            'borderInsideHColor' => new Hex('FF0000'),
            'borderInsideVSize'  => Absolute::from('eop', 4),
            'borderInsideVColor' => new Hex('FF0000'),
            'cellMarginTop'      => Absolute::from('eop', 240),
            'cellMarginLeft'     => Absolute::from('eop', 240),
            'cellMarginRight'    => Absolute::from('eop', 240),
            'cellMarginBottom'   => Absolute::from('eop', 240),
            'alignment'          => JcTable::CENTER,
            'width'              => new Percent(100),
            'layout'             => Table::LAYOUT_FIXED,
        );
        foreach ($attributes as $key => $value) {
            $set = "set{$key}";
            $get = "get{$key}";
            $object->$set($value);
            $result = $object->$get();
            if ($result instanceof Absolute) {
                $result = $result->toInt('eop');
                $value = $value->toInt('eop');
            } elseif ($result instanceof Percent) {
                $result = $result->toInt();
                $value = $value->toInt();
            } elseif ($result instanceof BasicColor) {
                $result = $result->toHex();
                $value = $value->toHex();
            }
            $this->assertEquals($value, $result);
        }
    }

    /**
     * Test border color
     *
     * Set border color and test if each part has the same color
     * While looping, push values array to be asserted with getBorderColor
     */
    public function testBorderColor()
    {
        $object = new Table();
        $parts = array('Top', 'Left', 'Right', 'Bottom', 'InsideH', 'InsideV');

        $value = 'FF0000';
        $object->setBorderColor(new Hex($value));
        $values = array();
        foreach ($parts as $part) {
            $get = "getBorder{$part}Color";
            $values[] = $value;
            $this->assertEquals($value, $object->$get()->toHex());
        }
        $this->assertEquals($values, array_map(function ($value) {
            return $value->toHex();
        }, $object->getBorderColor()));
    }

    /**
     * Test border size
     *
     * Set border size and test if each part has the same size
     * While looping, push values array to be asserted with getBorderSize
     */
    public function testBorderSize()
    {
        $object = new Table();
        $parts = array('Top', 'Left', 'Right', 'Bottom', 'InsideH', 'InsideV');

        $value = 4;
        $object->setBorderSize(Absolute::from('eop', $value));
        $values = array();
        foreach ($parts as $part) {
            $get = "getBorder{$part}Size";
            $values[] = $value;
            $this->assertEquals($value, $object->$get()->toInt('eop'));
        }
        foreach ($object->getBorderSize() as $key => $size) {
            $this->assertEquals($values[$key], $size->toInt('eop'));
        }
    }

    public function testBorderStyle()
    {
        $object = new Table();
        $parts = array('Top', 'Left', 'Right', 'Bottom', 'InsideH', 'InsideV');

        $value = new BorderStyle('single');
        $object->setBorderStyle($value);
        $values = array();
        foreach ($parts as $part) {
            $get = "getBorder{$part}Style";
            $values[] = $value->getStyle();
            $this->assertEquals($value->getStyle(), $object->$get()->getStyle());
        }
        foreach ($object->getBorderStyle() as $key => $size) {
            $this->assertEquals($values[$key], $size->getStyle());
        }
    }

    /**
     * Test cell margin
     *
     * Set cell margin and test if each part has the same margin
     * While looping, push values array to be asserted with getCellMargin
     * Value is in twips
     */
    public function testCellMargin()
    {
        $object = new Table();
        $parts = array('Top', 'Left', 'Right', 'Bottom');

        $value = 240;
        $object->setCellMargin(Absolute::from('twip', $value));
        $values = array();
        foreach ($parts as $part) {
            $get = "getCellMargin{$part}";
            $values[] = $value;
            $this->assertEquals($value, $object->$get()->toInt('twip'));
        }
        $this->assertEquals($values, array_map(function ($value) {
            return $value->toInt('twip');
        }, $object->getCellMargin()));
        $this->assertTrue($object->hasMargin());
    }

    /**
     * Set style value for various special value types
     */
    public function testSetStyleValue()
    {
        $object = new Table();
        $object->setStyleValue('borderSize', Absolute::from('twip', 120));
        $object->setStyleValue('cellMargin', Absolute::from('twip', 240));
        $object->setStyleValue('borderColor', new Hex('999999'));

        $this->assertEquals(array(120, 120, 120, 120, 120, 120), array_map(function ($value) {
            return $value->toInt('twip');
        }, $object->getBorderSize()));
        $this->assertEquals(array(240, 240, 240, 240), array_map(function ($value) {
            return $value->toInt('twip');
        }, $object->getCellMargin()));
        $this->assertEquals(
            array('999999', '999999', '999999', '999999', '999999', '999999'),
            array_map(function ($value) {
                return $value->toHex();
            }, $object->getBorderColor())
        );
    }

    /**
     * Tests table cell spacing
     */
    public function testTableCellSpacing()
    {
        $object = new Table();
        $this->assertNull($object->getCellSpacing()->toInt('twip'));

        $object = new Table(array('cellSpacing' => Absolute::from('twip', 20)));
        $this->assertEquals(20, $object->getCellSpacing()->toInt('twip'));
    }

    /**
     * Tests table floating position
     */
    public function testTablePosition()
    {
        $object = new Table();
        $this->assertNull($object->getPosition());

        $object->setPosition(array('vertAnchor' => TablePosition::VANCHOR_PAGE));
        $this->assertNotNull($object->getPosition());
        $this->assertEquals(TablePosition::VANCHOR_PAGE, $object->getPosition()->getVertAnchor());
    }

    public function testIndent()
    {
        $indent = Absolute::from('twip', 100);

        $table = new Table(array('indent' => $indent));

        $this->assertSame($indent, $table->getIndent());
    }
}
