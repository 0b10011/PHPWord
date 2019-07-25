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

use PhpOffice\PhpWord\Style\Colors\Color;
use PhpOffice\PhpWord\Style\Colors\ColorInterface;
use PhpOffice\PhpWord\Style\Colors\Hex;

/**
 * Shading style
 *
 * @see  http://www.schemacentral.com/sc/ooxml/t-w_CT_Shd.html
 * @since 0.10.0
 */
class Shading extends AbstractStyle
{
    /**
     * Pattern constants (partly)
     *
     * @const string
     * @see  http://www.schemacentral.com/sc/ooxml/t-w_ST_Shd.html
     */
    const PATTERN_CLEAR = 'clear'; // No pattern
    const PATTERN_SOLID = 'solid'; // 100% fill pattern
    const PATTERN_HSTRIPE = 'horzStripe'; // Horizontal stripe pattern
    const PATTERN_VSTRIPE = 'vertStripe'; // Vertical stripe pattern
    const PATTERN_DSTRIPE = 'diagStripe'; // Diagonal stripe pattern
    const PATTERN_HCROSS = 'horzCross'; // Horizontal cross pattern
    const PATTERN_DCROSS = 'diagCross'; // Diagonal cross pattern

    /**
     * Shading pattern
     *
     * @var string
     * @see  http://www.schemacentral.com/sc/ooxml/t-w_ST_Shd.html
     */
    private $pattern = self::PATTERN_CLEAR;

    /**
     * Shading pattern color
     *
     * @var ColorInterface
     */
    private $color;

    /**
     * Shading background color
     *
     * @var ColorInterface
     */
    private $fill;

    /**
     * Create a new instance
     *
     * @param array $style
     */
    public function __construct($style = array())
    {
        $this->setColor(new Hex(null));
        $this->setFill(new Hex(null));
        $this->setStyleByArray($style);
    }

    /**
     * Get pattern
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set pattern
     *
     * @param string $value
     * @return self
     */
    public function setPattern($value = null)
    {
        $enum = array(
            self::PATTERN_CLEAR, self::PATTERN_SOLID, self::PATTERN_HSTRIPE,
            self::PATTERN_VSTRIPE, self::PATTERN_DSTRIPE, self::PATTERN_HCROSS, self::PATTERN_DCROSS,
        );
        $this->pattern = $this->setEnumVal($value, $enum, $this->pattern);

        return $this;
    }

    /**
     * Get color
     *
     * @return ColorInterface
     */
    public function getColor(): ColorInterface
    {
        return $this->color;
    }

    /**
     * Set pattern
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setColor(ColorInterface $value): self
    {
        $this->color = $value;

        return $this;
    }

    /**
     * Get fill
     *
     * @return ColorInterface
     */
    public function getFill(): ColorInterface
    {
        return $this->fill;
    }

    /**
     * Set fill
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setFill(ColorInterface $value): self
    {
        $this->fill = $value;

        return $this;
    }
}
