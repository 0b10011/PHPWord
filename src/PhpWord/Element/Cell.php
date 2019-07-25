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

namespace PhpOffice\PhpWord\Element;

use PhpOffice\PhpWord\Style\Cell as CellStyle;
use PhpOffice\PhpWord\Style\Lengths\Absolute;
use PhpOffice\PhpWord\Style\Lengths\Length;

/**
 * Table cell element
 */
class Cell extends AbstractContainer
{
    /**
     * @var string Container type
     */
    protected $container = 'Cell';

    /**
     * Cell width
     *
     * @var Absolute
     */
    private $width;

    /**
     * Cell style
     *
     * @var \PhpOffice\PhpWord\Style\Cell
     */
    private $style;

    /**
     * Create new instance
     *
     * @see http://officeopenxml.com/WPtableGrid.php
     * @param Absolute $width The element returns Absolute for the width, rather than Length like the style does. See link for documentation.
     * @param array|\PhpOffice\PhpWord\Style\Cell $style
     */
    public function __construct(Absolute $width = null, $style = null)
    {
        $this->width = $width ?? new Absolute(null);
        $this->style = $this->setNewStyle(new CellStyle(), $style, true);
    }

    /**
     * Get cell style
     *
     * @return \PhpOffice\PhpWord\Style\Cell
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Get cell width
     */
    public function getWidth(): Absolute
    {
        return $this->width;
    }
}
