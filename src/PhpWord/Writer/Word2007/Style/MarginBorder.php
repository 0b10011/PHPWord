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

namespace PhpOffice\PhpWord\Writer\Word2007\Style;

use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\Style\BorderStyle;
use PhpOffice\PhpWord\Style\Colors\AbstractColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Margin border style writer
 *
 * @since 0.10.0
 */
class MarginBorder extends AbstractStyle
{
    /**
     * Sizes
     *
     * @var Absolute[]
     */
    private $sizes = array();

    /**
     * Colors
     *
     * @var AbstractColor[]
     */
    private $colors = array();

    /**
     * Border styles
     *
     * @var BorderStyle[]
     */
    private $styles = array();

    /**
     * Other attributes
     *
     * @var array
     */
    private $attributes = array();

    /**
     * Write style.
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();

        $sides = array('top', 'left', 'right', 'bottom', 'insideH', 'insideV');

        foreach ($this->sizes as $i => $size) {
            if ($size !== null) {
                if (isset($this->colors[$i])) {
                    $color = $this->colors[$i];
                } else {
                    $color = new Hex(null);
                }
                $style = isset($this->styles[$i]) ? $this->styles[$i] : new BorderStyle('single');
                $this->writeSide($xmlWriter, $sides[$i], $this->sizes[$i], $color, $style);
            }
        }
    }

    /**
     * Write side.
     *
     * @param string $side
     * @param string $color
     * @param string $borderStyle
     */
    private function writeSide(XMLWriter $xmlWriter, $side, Absolute $width, AbstractColor $color, BorderStyle $borderStyle)
    {
        $xmlWriter->startElement('w:' . $side);
        if (!empty($this->colors)) {
            $color = $color->toHexOrName();
            if ($color === null && !empty($this->attributes)) {
                if (isset($this->attributes['defaultColor'])) {
                    $color = $this->attributes['defaultColor'];
                }
            }
            $xmlWriter->writeAttribute('w:val', $borderStyle->getStyle());
            $xmlWriter->writeAttribute('w:sz', $width->toInt('eop'));
            $xmlWriter->writeAttributeIf($color != null, 'w:color', $color);
            if (!empty($this->attributes)) {
                if (isset($this->attributes['space'])) {
                    $xmlWriter->writeAttribute('w:space', $this->attributes['space']);
                }
            }
        } else {
            $xmlWriter->writeAttribute('w:w', $width->toInt('twip'));
            $xmlWriter->writeAttribute('w:type', 'dxa');
        }
        $xmlWriter->endElement();
    }

    /**
     * Set sizes.
     */
    public function setSizes($values)
    {
        foreach ($values as $value) {
            if (!($value instanceof Absolute)) {
                throw new Exception('An array of `Absolute` must be provided. `' . gettype($value) . '` provided');
            }
        }
        $this->sizes = $values;
    }

    /**
     * Set colors.
     */
    public function setColors(array $values): self
    {
        foreach ($values as $value) {
            if (!($value instanceof AbstractColor)) {
                throw new Exception('An array of `AbstractColor` must be provided. `' . gettype($value) . '` provided');
            }
        }
        $this->colors = $values;

        return $this;
    }

    /**
     * Set border styles.
     *
     * @param BorderStyle[] $value
     */
    public function setStyles($value)
    {
        $this->styles = $value;
    }

    /**
     * Set attributes.
     *
     * @param array $value
     */
    public function setAttributes($value)
    {
        $this->attributes = $value;
    }
}
