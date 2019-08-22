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

use PhpOffice\PhpWord\Style\Colors\BasicColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

trait Border
{
    protected $borders = [];

    protected function getAllowedSides(): array {
        return [
            'top',
            'bottom',
            'left',
            'right',
        ];
    }

    /**
     * Get all borders
     *
     * @return BorderSide[]
     */
    public function getBorders(): array
    {
        $borders = [];
        foreach ($this->borders as $side => $border) {
            $borders[$side] = clone $border;
        }
        return $borders;
    }

    /**
     * Get specific border
     */
    public function getBorder(string $side): BorderSide
    {
        if (in_array($side, $this->getAllowedSides())) {

        }
        return $this->borders[$side];
    }

    /**
     * Set same border for all sides
     */
    public function setBorder(BorderSide $borderSide): self
    {
        foreach ($this->getAllowedSides() as $name) {
            $this->borders[$name] = clone $borderSide;
        }

        return $this;
    }

    /**
     * Check if any borders have been added
     */
    public function hasBorder(): bool
    {
        return !empty($this->borders);
    }
}
