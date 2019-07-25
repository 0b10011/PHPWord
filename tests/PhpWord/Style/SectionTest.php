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
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Test class for PhpOffice\PhpWord\Style\Section
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Element\Section
 * @runTestsInSeparateProcesses
 */
class SectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Executed before each method of the class
     */
    public function testSettingValue()
    {
        $oSettings = new Section();

        $this->assertEquals('portrait', $oSettings->getOrientation());
        $this->assertEquals(Section::DEFAULT_WIDTH, $oSettings->getPageSizeW()->toFloat('twip'), '', .00000001);
        $this->assertEquals(Section::DEFAULT_HEIGHT, $oSettings->getPageSizeH()->toFloat('twip'), '', .00000001);
        $this->assertEquals('A4', $oSettings->getPaperSize());

        $oSettings->setSettingValue('orientation', 'landscape');
        $this->assertEquals('landscape', $oSettings->getOrientation());
        $this->assertEquals(Section::DEFAULT_HEIGHT, $oSettings->getPageSizeW()->toFloat('twip'), '', .00000001);
        $this->assertEquals(Section::DEFAULT_WIDTH, $oSettings->getPageSizeH()->toFloat('twip'), '', .00000001);

        $iVal = rand(1, 1000);
        $oSettings->setSettingValue('borderSize', Absolute::from('twip', $iVal));
        $this->assertEquals(array($iVal, $iVal, $iVal, $iVal), array_map(function ($value) {
            return $value->toInt('twip');
        }, $oSettings->getBorderSize()));
        $this->assertEquals($iVal, $oSettings->getBorderBottomSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderLeftSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderRightSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderTopSize()->toInt('twip'));

        $oSettings->setSettingValue('borderColor', new Hex('FF00AA'));
        $this->assertEquals(array('FF00AA', 'FF00AA', 'FF00AA', 'FF00AA'), array_map(function ($value) {
            return $value->toHex();
        }, $oSettings->getBorderColor()));
        $this->assertEquals('FF00AA', $oSettings->getBorderBottomColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderLeftColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderRightColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderTopColor()->toHex());

        $iVal = rand(1, 1000);
        $oSettings->setSettingValue('headerHeight', Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getHeaderHeight()->toInt('twip'));

        $oSettings->setSettingValue('lineNumbering', array());
        $oSettings->setSettingValue(
            'lineNumbering',
            array(
                'start'     => 1,
                'increment' => 1,
                'distance'  => 240,
                'restart'   => 'newPage',
            )
        );
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\LineNumbering', $oSettings->getLineNumbering());

        $oSettings->setSettingValue('lineNumbering', null);
        $this->assertNull($oSettings->getLineNumbering());
    }

    /**
     * Set/get margin
     */
    public function testMargin()
    {
        // Section Settings
        $oSettings = new Section();

        $iVal = rand(1, 1000);
        $oSettings->setMarginTop(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getMarginTop()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setMarginBottom(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getMarginBottom()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setMarginLeft(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getMarginLeft()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setMarginRight(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getMarginRight()->toInt('twip'));
    }

    /**
     * Set/get page width
     */
    public function testPageWidth()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertEquals(Section::DEFAULT_WIDTH, $oSettings->getPageSizeW()->toFloat('twip'), '', 0.000000001);
        $iVal = rand(1, 1000);
        $oSettings->setSettingValue('pageSizeW', Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getPageSizeW()->toFloat('twip'));
    }

    /**
     * Set/get page height
     */
    public function testPageHeight()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertEquals(Section::DEFAULT_HEIGHT, $oSettings->getPageSizeH()->toFloat('twip'), '', 0.000000001);
        $iVal = rand(1, 1000);
        $oSettings->setSettingValue('pageSizeH', Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getPageSizeH()->toInt('twip'));
    }

    /**
     * Set/get landscape orientation
     */
    public function testOrientationLandscape()
    {
        // Section Settings
        $oSettings = new Section();

        $oSettings->setLandscape();
        $this->assertEquals('landscape', $oSettings->getOrientation());
        $this->assertEquals(Section::DEFAULT_HEIGHT, $oSettings->getPageSizeW()->toFloat('twip'), '', 0.000000001);
        $this->assertEquals(Section::DEFAULT_WIDTH, $oSettings->getPageSizeH()->toFloat('twip'), '', 0.000000001);
    }

    /**
     * Set/get portrait orientation
     */
    public function testOrientationPortrait()
    {
        // Section Settings
        $oSettings = new Section();

        $oSettings->setPortrait();
        $this->assertEquals('portrait', $oSettings->getOrientation());
        $this->assertEquals(Section::DEFAULT_WIDTH, $oSettings->getPageSizeW()->toFloat('twip'), '', 0.000000001);
        $this->assertEquals(Section::DEFAULT_HEIGHT, $oSettings->getPageSizeH()->toFloat('twip'), '', 0.000000001);
    }

    /**
     * Set/get border size
     */
    public function testBorderSize()
    {
        // Section Settings
        $oSettings = new Section();

        $iVal = rand(1, 1000);
        $oSettings->setBorderSize(Absolute::from('twip', $iVal));
        $this->assertEquals(array($iVal, $iVal, $iVal, $iVal), array_map(function ($value) {
            return $value->toInt('twip');
        }, $oSettings->getBorderSize()));
        $this->assertEquals($iVal, $oSettings->getBorderBottomSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderLeftSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderRightSize()->toInt('twip'));
        $this->assertEquals($iVal, $oSettings->getBorderTopSize()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setBorderBottomSize(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getBorderBottomSize()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setBorderLeftSize(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getBorderLeftSize()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setBorderRightSize(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getBorderRightSize()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setBorderTopSize(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getBorderTopSize()->toInt('twip'));
    }

    /**
     * Set/get border color
     */
    public function testBorderColor()
    {
        // Section Settings
        $oSettings = new Section();

        $oSettings->setBorderColor(new Hex('FF00AA'));
        $this->assertEquals(array('FF00AA', 'FF00AA', 'FF00AA', 'FF00AA'), array_map(function ($value) {
            return $value->toHex();
        }, $oSettings->getBorderColor()));
        $this->assertEquals('FF00AA', $oSettings->getBorderBottomColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderLeftColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderRightColor()->toHex());
        $this->assertEquals('FF00AA', $oSettings->getBorderTopColor()->toHex());

        $oSettings->setBorderBottomColor(new Hex('BBCCDD'));
        $this->assertEquals('BBCCDD', $oSettings->getBorderBottomColor()->toHex());

        $oSettings->setBorderLeftColor(new Hex('CCDDEE'));
        $this->assertEquals('CCDDEE', $oSettings->getBorderLeftColor()->toHex());

        $oSettings->setBorderRightColor(new Hex('11EE22'));
        $this->assertEquals('11EE22', $oSettings->getBorderRightColor()->toHex());

        $oSettings->setBorderTopColor(new Hex('22FF33'));
        $this->assertEquals('22FF33', $oSettings->getBorderTopColor()->toHex());
    }

    /**
     * Set/get page numbering start
     */
    public function testNumberingStart()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertNull($oSettings->getPageNumberingStart());

        $iVal = rand(1, 1000);
        $oSettings->setPageNumberingStart($iVal);
        $this->assertEquals($iVal, $oSettings->getPageNumberingStart());

        $oSettings->setPageNumberingStart();
        $this->assertNull($oSettings->getPageNumberingStart());
    }

    /**
     * Set/get header height
     */
    public function testHeader()
    {
        $oSettings = new Section();

        $this->assertEquals(720, $oSettings->getHeaderHeight()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setHeaderHeight(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getHeaderHeight()->toInt('twip'));
    }

    /**
     * Set/get header height
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^(Argument 1 passed to PhpOffice\\PhpWord\\Style\\Section::setHeaderHeight\(\) must be an instance of PhpOffice\\PhpWord\\Style\\Lengths\\Absolute, none given|Too few arguments to function PhpOffice\\PhpWord\\Style\\Section::setHeaderHeight\(\), 0 passed)/
     */
    public function testHeaderMissing()
    {
        $oSettings = new Section();
        $oSettings->setHeaderHeight();
    }

    /**
     * Set/get footer height
     */
    public function testFooter()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertEquals(720, $oSettings->getFooterHeight()->toInt('twip'));

        $iVal = rand(1, 1000);
        $oSettings->setFooterHeight(Absolute::from('twip', $iVal));
        $this->assertEquals($iVal, $oSettings->getFooterHeight()->toInt('twip'));
    }

    /**
     * Set/get footer height
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^(Argument 1 passed to PhpOffice\\PhpWord\\Style\\Section::setFooterHeight\(\) must be an instance of PhpOffice\\PhpWord\\Style\\Lengths\\Absolute, none given|Too few arguments to function PhpOffice\\PhpWord\\Style\\Section::setFooterHeight\(\), 0 passed)/
     */
    public function testFooterEmpty()
    {
        $oSettings = new Section();
        $oSettings->setFooterHeight();
    }

    /**
     * Set/get column number
     */
    public function testColumnsNum()
    {
        // Section Settings
        $oSettings = new Section();

        // Default
        $this->assertEquals(1, $oSettings->getColsNum());

        // Null value
        $oSettings->setColsNum();
        $this->assertEquals(1, $oSettings->getColsNum());

        // Random value
        $iVal = rand(1, 1000);
        $oSettings->setColsNum($iVal);
        $this->assertEquals($iVal, $oSettings->getColsNum());
    }

    /**
     * Set/get column spacing
     */
    public function testColumnsSpace()
    {
        // Section Settings
        $oSettings = new Section();

        // Default
        $this->assertEquals(720, $oSettings->getColsSpace()->toInt('twip'));

        $iVal = rand(1, 1000);
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\Section', $oSettings->setColsSpace(Absolute::from('twip', $iVal)));
        $this->assertEquals($iVal, $oSettings->getColsSpace()->toInt('twip'));
    }

    /**
     * Set/get column spacing
     * PHP 7.1+
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^(Argument 1 passed to PhpOffice\\PhpWord\\Style\\Section::setColsSpace\(\) must be an instance of PhpOffice\\PhpWord\\Style\\Lengths\\Absolute, none given|Too few arguments to function PhpOffice\\PhpWord\\Style\\Section::setColsSpace\(\), 0 passed)/
     */
    public function testColumnsSpaceEmpty()
    {
        $oSettings = new Section();
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\Section', $oSettings->setColsSpace());
    }

    /**
     * Set/get break type
     */
    public function testBreakType()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertNull($oSettings->getBreakType());

        $oSettings->setBreakType('continuous');
        $this->assertEquals('continuous', $oSettings->getBreakType());

        $oSettings->setBreakType();
        $this->assertNull($oSettings->getBreakType());
    }

    /**
     * Vertical page alignment
     */
    public function testVerticalAlign()
    {
        // Section Settings
        $oSettings = new Section();

        $this->assertNull($oSettings->getVAlign());

        $oSettings->setVAlign(VerticalJc::BOTH);
        $this->assertEquals('both', $oSettings->getVAlign());
    }
}
