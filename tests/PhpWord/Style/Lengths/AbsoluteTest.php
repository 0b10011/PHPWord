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

namespace PhpOffice\PhpWord\Style\Lengths;

use PhpOffice\PhpWord\Shared\HtmlDpi as Dpi;

/**
 * Test class for PhpOffice\PhpWord\Shared\Converter
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Shared\Converter
 */
class AbsoluteTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test unit conversion functions with various numbers
     */
    public function testUnitConversions()
    {
        $values = array();
        $values[] = 0; // zero value
        $values[] = rand(1, 100) / 100; // fraction number
        $values[] = rand(1, 100); // integer

        foreach ($values as $value) {
            $result = Absolute::from('cm', $value);
            $this->assertEquals($value / 2.54 * 1440, $result->toFloat('twip'));

            $result = Absolute::from('cm', $value);
            $this->assertEquals($value / 2.54, $result->toFloat('in'));

            $result = Absolute::from('cm', $value);
            $this->assertEquals(round($value / 2.54 * 96), $result->toPixels(new Dpi()));

            $result = Absolute::from('cm', $value);
            $this->assertEquals($value / 2.54 * 72, $result->toFloat('pt'));

            $result = Absolute::from('cm', $value);
            $this->assertEquals($value / 2.54 * 72 * 8, $result->toFloat('eop'));

            $result = Absolute::from('in', $value);
            $this->assertEquals($value * 1440, $result->toFloat('twip'));

            $result = Absolute::from('in', $value);
            $this->assertEquals($value * 2.54, $result->toFloat('cm'));

            $result = Absolute::from('in', $value);
            $this->assertEquals(round($value * 96), $result->toPixels(new Dpi()));

            $result = Absolute::from('in', $value);
            $this->assertEquals($value * 72, $result->toFloat('pt'));

            $result = Absolute::from('in', $value);
            $this->assertEquals($value * 1440 / 2.5, $result->toFloat('eop'));

            $result = Absolute::fromPixels(new Dpi(), $value);
            $this->assertEquals($value / 96 * 1440, $result->toFloat('twip'));

            $result = Absolute::fromPixels(new Dpi(), $value);
            $this->assertEquals($value / 96 * 2.54, $result->toFloat('cm'));

            $result = Absolute::fromPixels(new Dpi(), $value);
            $this->assertEquals($value / 96 * 72, $result->toFloat('pt'));

            $result = Absolute::fromPixels(new Dpi(), $value);
            $this->assertEquals($value / 96 * 1440 / 2.5, $result->toFloat('eop'));

            $result = Absolute::from('pt', $value);
            $this->assertEquals($value * 20, $result->toFloat('twip'));

            $result = Absolute::from('pt', $value);
            $this->assertEquals($value * 0.035277778, $result->toFloat('cm'), '', 0.00001);

            $result = Absolute::from('pt', $value);
            $this->assertEquals(round($value / 72 * 96), $result->toPixels(new Dpi()));

            $result = Absolute::from('pt', $value);
            $this->assertEquals($value * 20 / 2.5, $result->toFloat('eop'));

            $result = Absolute::from('eop', $value);
            $this->assertEquals(round($value * 2.5 / 1440 * 96), $result->toPixels(new Dpi()));

            $result = Absolute::from('pc', $value);
            $this->assertEquals($value, $result->toFloat('pc'), '', 0.00001);

            // FIXME If necessary, add support and uncomment
            // $result = Absolute::from('deg', $value);
            // $this->assertEquals((int) round($value * 60000), $result->toFloat('angle'));
            //
            // $result = Absolute::from('angle', $value);
            // $this->assertEquals(round($value / 60000), $result->toFloat('deg'));
        }
    }
}
