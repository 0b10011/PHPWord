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

namespace PhpOffice\PhpWord\Writer\RTF\Style;

use PhpOffice\PhpWord\Style\Colors\BasicColor;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Border style writer
 *
 * @since 0.12.0
 */
class Border extends AbstractStyle
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
     * @var BasicColor[]
     */
    private $colors = array();

    /**
     * Write style
     *
     * @return string
     */
    public function write()
    {
        $content = '';

        $sides = array('top', 'left', 'right', 'bottom');
        $sizeCount = count($this->sizes);

        // Page border measure
        // 8 = from text, infront off; 32 = from edge, infront on; 40 = from edge, infront off
        $content .= '\pgbrdropt32';

        for ($i = 0; $i < $sizeCount; $i++) {
            if (!$this->sizes[$i]->isSpecified()) {
                continue;
            }

            $color = $this->colors[$i] ?? new Hex(null);
            $content .= $this->writeSide($sides[$i], $this->sizes[$i], $color);
        }

        return $content;
    }

    /**
     * Write side
     *
     * @param string $side
     * @param int $width FIXME Switch to Absolute or Length maybe?
     * @param string $color
     * @return string
     */
    private function writeSide($side, Absolute $width, BasicColor $color)
    {
        /** @var \PhpOffice\PhpWord\Writer\RTF $rtfWriter */
        $rtfWriter = $this->getParentWriter();
        $colorIndex = 0;
        if ($rtfWriter !== null) {
            $colorTable = $rtfWriter->getColorTable();
            $index = array_search($color->toHexOrName(), $colorTable);
            if ($index !== false && $colorIndex !== null) {
                $colorIndex = $index + 1;
            }
        }

        $content = '';

        $content .= '\pgbrdr' . substr($side, 0, 1);
        $content .= '\brdrs'; // Single-thickness border; @todo Get other type of border
        $content .= '\brdrw' . $width->toInt('twip'); // Width
        $content .= '\brdrcf' . $colorIndex; // Color
        $content .= '\brsp480'; // Space in twips between borders and the paragraph (24pt, following OOXML)
        $content .= ' ';

        return $content;
    }

    /**
     * Set sizes.
     *
     * @param Absolute[] $value
     */
    public function setSizes($value)
    {
        $this->sizes = $value;
    }

    /**
     * Set colors.
     *
     * @param BasicColor[] $value
     */
    public function setColors($value)
    {
        $this->colors = $value;
    }
}
