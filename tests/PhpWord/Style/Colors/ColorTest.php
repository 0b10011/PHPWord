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

namespace PhpOffice\PhpWord\Style\Colors;

/**
 * @coversDefaultClass \PhpOffice\PhpWord\Style\Colors\Color
 */
class ColorTest extends \PHPUnit\Framework\TestCase
{
    public function testConversions()
    {
        // Prepare test values [ original, expected ]
        $values = array(
            array('yellow', HighlightColor::class, 'yellow'),
            array('window', SystemColor::class, 'window'),
            array('a0b', Hex::class, 'AA00BB'),
            array('aB01cD', Hex::class, 'AB01CD'),
            array('', AbstractColor::class, null),
            array('auto', AbstractColor::class, null),
            array(null, AbstractColor::class, null),
            array(new Hex('fff'), Hex::class, 'FFFFFF'),
            array(new Rgb(0, 102, 255), Rgb::class, '0066FF'),
            array(new SystemColor('window'), SystemColor::class, 'window'),
            array(new HighlightColor('green'), HighlightColor::class, 'green'),
        );
        // Conduct test
        foreach ($values as $value) {
            $message = serialize($value[0]) . ' should be a valid color and converted to ' . $value[1];
            $color = Color::fromMixed($value[0]);
            $this->assertInstanceOf($value[1], $color, $message);
            $this->assertEquals($value[2], $color->toHexOrName(), $message);
        }
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage All colors must implement NamedAbstractColor or StaticAbstractColor. 'class@anonymous
     */
    public function testBadClass()
    {
        $color = Color::fromMixed(new class() extends AbstractColor {
        });
        $color->toHexOrName();
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Color `fakeColor` is not a valid color
     */
    public function testInvalidColor()
    {
        Color::fromMixed('fakeColor');
    }

    public function testValueInvalidColor()
    {
        $color = @Color::fromMixed('fakeColor');
        $this->assertInstanceOf(AbstractColor::class, $color);
        $this->assertNull($color->toHexOrName());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Color cannot be instantiated
     */
    public function testInstantiation()
    {
        new Color();
    }
}
