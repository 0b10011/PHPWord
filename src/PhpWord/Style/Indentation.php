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

use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Paragraph indentation style
 *
 * @see  http://www.schemacentral.com/sc/ooxml/t-w_CT_Ind.html
 * @since 0.10.0
 */
class Indentation extends AbstractStyle
{
    /**
     * Left indentation
     *
     * @var Absolute
     */
    private $left = 0;

    /**
     * Right indentation
     *
     * @var Absolute
     */
    private $right = 0;

    /**
     * Additional first line indentation
     *
     * @var Absolute
     */
    private $firstLine;

    /**
     * Indentation removed from first line
     *
     * @var Absolute
     */
    private $hanging;

    /**
     * Create a new instance
     *
     * @param array $style
     */
    public function __construct($style = array())
    {
        $this->setLeft(new Absolute(0));
        $this->setRight(new Absolute(0));
        $this->setFirstLine(new Absolute(null));
        $this->setHanging(new Absolute(null));
        $this->setStyleByArray($style);
    }

    /**
     * Get left
     */
    public function getLeft(): Absolute
    {
        return $this->left;
    }

    /**
     * Set left
     */
    public function setLeft(Absolute $value): self
    {
        $this->left = $value;

        return $this;
    }

    /**
     * Get right
     */
    public function getRight(): Absolute
    {
        return $this->right;
    }

    /**
     * Set right
     */
    public function setRight(Absolute $value): self
    {
        $this->right = $value;

        return $this;
    }

    /**
     * Get first line
     */
    public function getFirstLine(): Absolute
    {
        return $this->firstLine;
    }

    /**
     * Set first line
     */
    public function setFirstLine(Absolute $value): self
    {
        $this->firstLine = $value;

        return $this;
    }

    /**
     * Get hanging
     */
    public function getHanging(): Absolute
    {
        return $this->hanging;
    }

    /**
     * Set hanging
     */
    public function setHanging(Absolute $value): self
    {
        $this->hanging = $value;

        return $this;
    }
}
