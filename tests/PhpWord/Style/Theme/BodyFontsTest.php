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

namespace PhpOffice\PhpWord\Style\Theme;

/**
 * @coversDefaultClass \PhpOffice\PhpWord\Style\Theme\BodyFonts
 */
class BodyFontsTest extends \PHPUnit\Framework\TestCase
{
    public function testDefaults()
    {
        $fontScheme = new BodyFonts();
        $this->assertEquals('Calibri', $fontScheme->getLatin());
        $this->assertEquals('', $fontScheme->getEastAsian());
        $this->assertEquals('', $fontScheme->getComplexScript());
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFont('Jpan'));
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFonts()['Jpan']);
    }

    public function testCustomLatin()
    {
        $fontScheme = new BodyFonts(array('Latin' => 'Custom Font'));

        $this->assertEquals('Custom Font', $fontScheme->getLatin());
        $this->assertEquals('', $fontScheme->getEastAsian());
        $this->assertEquals('', $fontScheme->getComplexScript());
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFont('Jpan'));
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFonts()['Jpan']);
    }

    public function testCustomEastAsian()
    {
        $fontScheme = new BodyFonts(array('EastAsian' => 'Custom Font'));

        $this->assertEquals('Calibri', $fontScheme->getLatin());
        $this->assertEquals('Custom Font', $fontScheme->getEastAsian());
        $this->assertEquals('', $fontScheme->getComplexScript());
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFont('Jpan'));
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFonts()['Jpan']);
    }

    public function testCustomComplexScript()
    {
        $fontScheme = new BodyFonts(array('ComplexScript' => 'Custom Font'));

        $this->assertEquals('Calibri', $fontScheme->getLatin());
        $this->assertEquals('', $fontScheme->getEastAsian());
        $this->assertEquals('Custom Font', $fontScheme->getComplexScript());
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFont('Jpan'));
        $this->assertEquals('ＭＳ 明朝', $fontScheme->getFonts()['Jpan']);
    }

    public function testCustomFont()
    {
        $fontScheme = new BodyFonts(array('Jpan' => 'Custom Font'));

        $this->assertEquals('Calibri', $fontScheme->getLatin());
        $this->assertEquals('', $fontScheme->getEastAsian());
        $this->assertEquals('', $fontScheme->getComplexScript());
        $this->assertEquals('Custom Font', $fontScheme->getFont('Jpan'));
        $this->assertEquals('Custom Font', $fontScheme->getFonts()['Jpan']);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid script 'BadScript' provided
     */
    public function testSettingBadFont()
    {
        new BodyFonts(array('BadScript' => 'Custom Font'));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No font found for script 'BadScript' in color scheme 'PhpOffice\PhpWord\Style\Theme\BodyFonts'
     */
    public function testGettingBadFont()
    {
        $bodyFonts = new BodyFonts();
        $bodyFonts->getFont('BadScript');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No font found for script 'BadScript' in color scheme 'PhpOffice\PhpWord\Style\Theme\Fonts'
     */
    public function testGettingBadDefaultFont()
    {
        HeadingFonts::getDefaultFont('BadScript');
    }
}
