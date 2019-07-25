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
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Border style
 */
class Border extends AbstractStyle
{
    /**
     * Border Top Size
     *
     * @var Absolute
     */
    protected $borderTopSize;

    /**
     * Border Top Color
     *
     * @var ColorInterface
     */
    protected $borderTopColor;

    /**
     * Border Top Style
     *
     * @var BorderStyle
     */
    protected $borderTopStyle;

    /**
     * Border Left Size
     *
     * @var Absolute
     */
    protected $borderLeftSize;

    /**
     * Border Left Color
     *
     * @var ColorInterface
     */
    protected $borderLeftColor;

    /**
     * Border Left Style
     *
     * @var BorderStyle
     */
    protected $borderLeftStyle;

    /**
     * Border Right Size
     *
     * @var Absolute
     */
    protected $borderRightSize;

    /**
     * Border Right Color
     *
     * @var ColorInterface
     */
    protected $borderRightColor;

    /**
     * Border Right Style
     *
     * @var BorderStyle
     */
    protected $borderRightStyle;

    /**
     * Border Bottom Size
     *
     * @var Absolute
     */
    protected $borderBottomSize;

    /**
     * Border Bottom Color
     *
     * @var ColorInterface
     */
    protected $borderBottomColor;

    /**
     * Border Bottom Style
     *
     * @var BorderStyle
     */
    protected $borderBottomStyle;

    public function __construct()
    {
        $this
            ->setBorderSize(new Absolute(null))
            ->setBorderColor(new Hex(null))
            ->setBorderStyle(new BorderStyle(null));
    }

    /**
     * Get border size
     *
     * @return Absolute[]
     */
    public function getBorderSize(): array
    {
        return array(
            $this->getBorderTopSize(),
            $this->getBorderLeftSize(),
            $this->getBorderRightSize(),
            $this->getBorderBottomSize(),
        );
    }

    /**
     * Set border size
     *
     * @param Absolute $value
     * @return self
     */
    public function setBorderSize(Absolute $value): self
    {
        $this
            ->setBorderTopSize($value)
            ->setBorderLeftSize($value)
            ->setBorderRightSize($value)
            ->setBorderBottomSize($value);

        return $this;
    }

    /**
     * Get border color
     *
     * @return ColorInterface[]
     */
    public function getBorderColor(): array
    {
        return array(
            $this->getBorderTopColor(),
            $this->getBorderLeftColor(),
            $this->getBorderRightColor(),
            $this->getBorderBottomColor(),
        );
    }

    /**
     * Set border color
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBorderColor(ColorInterface $value)
    {
        $this->setBorderTopColor($value);
        $this->setBorderLeftColor($value);
        $this->setBorderRightColor($value);
        $this->setBorderBottomColor($value);

        return $this;
    }

    /**
     * Get border style
     *
     * @return BorderStyle[]
     */
    public function getBorderStyle(): array
    {
        return array(
            $this->getBorderTopStyle(),
            $this->getBorderLeftStyle(),
            $this->getBorderRightStyle(),
            $this->getBorderBottomStyle(),
        );
    }

    /**
     * Set border style
     *
     * @param BorderStyle $value
     * @return self
     */
    public function setBorderStyle(BorderStyle $value)
    {
        $this->setBorderTopStyle($value);
        $this->setBorderLeftStyle($value);
        $this->setBorderRightStyle($value);
        $this->setBorderBottomStyle($value);

        return $this;
    }

    /**
     * Get border top size
     *
     * @return Absolute
     */
    public function getBorderTopSize(): Absolute
    {
        return $this->borderTopSize;
    }

    /**
     * Set border top size
     *
     * @param Absolute $value
     * @return self
     */
    public function setBorderTopSize(Absolute $value): self
    {
        $this->borderTopSize = $value;

        return $this;
    }

    /**
     * Get border top color
     *
     * @return ColorInterface
     */
    public function getBorderTopColor(): ColorInterface
    {
        return $this->borderTopColor;
    }

    /**
     * Set border top color
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBorderTopColor(ColorInterface $value)
    {
        $this->borderTopColor = $value;

        return $this;
    }

    /**
     * Get border top style
     *
     * @return BorderStyle
     */
    public function getBorderTopStyle(): BorderStyle
    {
        return $this->borderTopStyle;
    }

    /**
     * Set border top style
     *
     * @param BorderStyle $value
     * @return self
     */
    public function setBorderTopStyle(BorderStyle $value)
    {
        $this->borderTopStyle = $value;

        return $this;
    }

    /**
     * Get border left size
     *
     * @return Absolute
     */
    public function getBorderLeftSize(): Absolute
    {
        return $this->borderLeftSize;
    }

    /**
     * Set border left size
     *
     * @param Absolute $value
     * @return self
     */
    public function setBorderLeftSize(Absolute $value): self
    {
        $this->borderLeftSize = $value;

        return $this;
    }

    /**
     * Get border left color
     *
     * @return ColorInterface
     */
    public function getBorderLeftColor(): ColorInterface
    {
        return $this->borderLeftColor;
    }

    /**
     * Set border left color
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBorderLeftColor(ColorInterface $value)
    {
        $this->borderLeftColor = $value;

        return $this;
    }

    /**
     * Get border left style
     *
     * @return BorderStyle
     */
    public function getBorderLeftStyle(): BorderStyle
    {
        return $this->borderLeftStyle;
    }

    /**
     * Set border left style
     *
     * @param BorderStyle $value
     * @return self
     */
    public function setBorderLeftStyle(BorderStyle $value)
    {
        $this->borderLeftStyle = $value;

        return $this;
    }

    /**
     * Get border right size
     *
     * @return Absolute
     */
    public function getBorderRightSize(): Absolute
    {
        return $this->borderRightSize;
    }

    /**
     * Set border right size
     *
     * @param Absolute $value
     * @return self
     */
    public function setBorderRightSize(Absolute $value): self
    {
        $this->borderRightSize = $value;

        return $this;
    }

    /**
     * Get border right color
     *
     * @return ColorInterface
     */
    public function getBorderRightColor(): ColorInterface
    {
        return $this->borderRightColor;
    }

    /**
     * Set border right color
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBorderRightColor(ColorInterface $value)
    {
        $this->borderRightColor = $value;

        return $this;
    }

    /**
     * Get border right style
     *
     * @return BorderStyle
     */
    public function getBorderRightStyle(): BorderStyle
    {
        return $this->borderRightStyle;
    }

    /**
     * Set border right style
     *
     * @param BorderStyle $value
     * @return self
     */
    public function setBorderRightStyle(BorderStyle $value)
    {
        $this->borderRightStyle = $value;

        return $this;
    }

    /**
     * Get border bottom size
     *
     * @return Absolute
     */
    public function getBorderBottomSize(): Absolute
    {
        return $this->borderBottomSize;
    }

    /**
     * Set border bottom size
     *
     * @param Absolute $value
     * @return self
     */
    public function setBorderBottomSize(Absolute $value): self
    {
        $this->borderBottomSize = $value;

        return $this;
    }

    /**
     * Get border bottom color
     *
     * @return ColorInterface
     */
    public function getBorderBottomColor(): ColorInterface
    {
        return $this->borderBottomColor;
    }

    /**
     * Set border bottom color
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBorderBottomColor(ColorInterface $value)
    {
        $this->borderBottomColor = $value;

        return $this;
    }

    /**
     * Get border bottom style
     *
     * @return BorderStyle
     */
    public function getBorderBottomStyle(): BorderStyle
    {
        return $this->borderBottomStyle;
    }

    /**
     * Set border bottom style
     *
     * @param BorderStyle $value
     * @return self
     */
    public function setBorderBottomStyle(BorderStyle $value)
    {
        $this->borderBottomStyle = $value;

        return $this;
    }

    /**
     * Check if any of the border is not null
     *
     * @return bool
     */
    public function hasBorder(): bool
    {
        foreach ($this->getBorderSize() as $border) {
            if ($border->toInt('twip') !== null) {
                return true;
            }
        }

        return false;
    }
}
