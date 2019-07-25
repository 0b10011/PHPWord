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
use PhpOffice\PhpWord\Style\Colors\ForegroundColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Font style
 */
class Font extends AbstractStyle
{
    /**
     * Underline types
     *
     * @const string
     */
    const UNDERLINE_NONE = 'none';
    const UNDERLINE_DASH = 'dash';
    const UNDERLINE_DASHHEAVY = 'dashHeavy';
    const UNDERLINE_DASHLONG = 'dashLong';
    const UNDERLINE_DASHLONGHEAVY = 'dashLongHeavy';
    const UNDERLINE_DOUBLE = 'dbl';
    /**
     * @deprecated use UNDERLINE_DOTHASH instead, TODO remove in version 1.0
     */
    const UNDERLINE_DOTHASH = 'dotDash';  // Incorrect spelling, for backwards compatibility
    /**
     * @deprecated use UNDERLINE_DOTDASHHEAVY instead, TODO remove in version 1.0
     */
    const UNDERLINE_DOTHASHHEAVY = 'dotDashHeavy';  // Incorrect spelling, for backwards compatibility
    const UNDERLINE_DOTDASH = 'dotDash';
    const UNDERLINE_DOTDASHHEAVY = 'dotDashHeavy';
    const UNDERLINE_DOTDOTDASH = 'dotDotDash';
    const UNDERLINE_DOTDOTDASHHEAVY = 'dotDotDashHeavy';
    const UNDERLINE_DOTTED = 'dotted';
    const UNDERLINE_DOTTEDHEAVY = 'dottedHeavy';
    const UNDERLINE_HEAVY = 'heavy';
    const UNDERLINE_SINGLE = 'single';
    const UNDERLINE_WAVY = 'wavy';
    const UNDERLINE_WAVYDOUBLE = 'wavyDbl';
    const UNDERLINE_WAVYHEAVY = 'wavyHeavy';
    const UNDERLINE_WORDS = 'words';

    /**
     * Aliases
     *
     * @var array
     */
    protected $aliases = array('line-height' => 'lineHeight', 'letter-spacing' => 'spacing');

    /**
     * Font style type
     *
     * @var string
     */
    private $type;

    /**
     * Font name
     *
     * @var string
     */
    private $name;

    /**
     * Font Content Type
     *
     * @var string
     */
    private $hint;

    /**
     * Font size
     *
     * @var Absolute
     */
    private $size;

    /**
     * Font color
     *
     * @var ColorInterface
     */
    private $color;

    /**
     * Bold
     *
     * @var bool
     */
    private $bold;

    /**
     * Italic
     *
     * @var bool
     */
    private $italic;

    /**
     * Undeline
     *
     * @var string
     */
    private $underline = self::UNDERLINE_NONE;

    /**
     * Superscript
     *
     * @var bool
     */
    private $superScript = false;

    /**
     * Subscript
     *
     * @var bool
     */
    private $subScript = false;

    /**
     * Strikethrough
     *
     * @var bool
     */
    private $strikethrough;

    /**
     * Double strikethrough
     *
     * @var bool
     */
    private $doubleStrikethrough;

    /**
     * Small caps
     *
     * @var bool
     * @see  http://www.schemacentral.com/sc/ooxml/e-w_smallCaps-1.html
     */
    private $smallCaps;

    /**
     * All caps
     *
     * @var bool
     * @see  http://www.schemacentral.com/sc/ooxml/e-w_caps-1.html
     */
    private $allCaps;

    /**
     * Foreground/highlight
     *
     * @var ForegroundColor
     */
    private $fgColor;

    /**
     * Expanded/compressed text: 0-600 (percent)
     *
     * @var int
     * @since 0.12.0
     * @see  http://www.schemacentral.com/sc/ooxml/e-w_w-1.html
     */
    private $scale;

    /**
     * Character spacing adjustment: twip
     *
     * @var Absolute
     * @since 0.12.0
     * @see  http://www.schemacentral.com/sc/ooxml/e-w_spacing-2.html
     */
    private $spacing;

    /**
     * Font kerning: halfpoint
     *
     * @var int|float
     * @since 0.12.0
     * @see  http://www.schemacentral.com/sc/ooxml/e-w_kern-1.html
     */
    private $kerning;

    /**
     * Paragraph style
     *
     * @var \PhpOffice\PhpWord\Style\Paragraph
     */
    private $paragraph;

    /**
     * Shading
     *
     * @var \PhpOffice\PhpWord\Style\Shading
     */
    private $shading;

    /**
     * Right to left languages
     *
     * @var bool
     */
    private $rtl;

    /**
     * noProof (disables AutoCorrect)
     *
     * @var bool
     * http://www.datypic.com/sc/ooxml/e-w_noProof-1.html
     */
    private $noProof;

    /**
     * Languages
     *
     * @var \PhpOffice\PhpWord\Style\Language
     */
    private $lang;

    /**
     * Hidden text
     *
     * @var bool
     * @see  http://www.datypic.com/sc/ooxml/e-w_vanish-1.html
     */
    private $hidden;

    /**
     * Vertically Raised or Lowered Text
     *
     * @var Absolute
     * @see http://www.datypic.com/sc/ooxml/e-w_position-1.html
     */
    private $position;

    /**
     * Create new font style
     *
     * @param string $type Type of font
     * @param array|string|\PhpOffice\PhpWord\Style\AbstractStyle $paragraph Paragraph styles definition
     */
    public function __construct($type = 'text', $paragraph = null)
    {
        $this
            ->setSize(new Absolute(null))
            ->setColor(new Hex(null))
            ->setFgColor(new ForegroundColor(null))
            ->setBgColor(new Hex(null))
            ->setSpacing(new Absolute(null));
        $this->type = $type;
        $this->setParagraph($paragraph);
    }

    /**
     * Get style values
     *
     * @return array
     * @since 0.12.0
     */
    public function getStyleValues()
    {
        $styles = array(
            'name'          => $this->getStyleName(),
            'basic'         => array(
                'name'      => $this->getName(),
                'size'      => $this->getSize(),
                'color'     => $this->getColor(),
                'hint'      => $this->getHint(),
            ),
            'style'         => array(
                'bold'      => $this->isBold(),
                'italic'    => $this->isItalic(),
                'underline' => $this->getUnderline(),
                'strike'    => $this->isStrikethrough(),
                'dStrike'   => $this->isDoubleStrikethrough(),
                'super'     => $this->isSuperScript(),
                'sub'       => $this->isSubScript(),
                'smallCaps' => $this->isSmallCaps(),
                'allCaps'   => $this->isAllCaps(),
                'fgColor'   => $this->getFgColor(),
                'hidden'    => $this->isHidden(),
            ),
            'spacing'       => array(
                'scale'     => $this->getScale(),
                'spacing'   => $this->getSpacing(),
                'kerning'   => $this->getKerning(),
                'position'  => $this->getPosition(),
            ),
            'paragraph'     => $this->getParagraph(),
            'rtl'           => $this->isRTL(),
            'shading'       => $this->getShading(),
            'lang'          => $this->getLang(),
        );

        return $styles;
    }

    /**
     * Get style type
     *
     * @return string
     */
    public function getStyleType()
    {
        return $this->type;
    }

    /**
     * Get font name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set font name
     *
     * @param string $value
     * @return self
     */
    public function setName($value = null)
    {
        $this->name = $value;

        return $this;
    }

    /**
     * Get Font Content Type
     *
     * @return string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Set Font Content Type
     *
     * @param string $value
     * @return self
     */
    public function setHint($value = null)
    {
        $this->hint = $value;

        return $this;
    }

    /**
     * Get font size
     *
     * @return Absolute
     */
    public function getSize(): Absolute
    {
        return $this->size;
    }

    /**
     * Set font size
     *
     * @param Absolute $value
     * @return self
     */
    public function setSize(Absolute $value): self
    {
        $this->size = $value;

        return $this;
    }

    /**
     * Get font color
     *
     * @return ColorInterface
     */
    public function getColor(): ColorInterface
    {
        return $this->color;
    }

    /**
     * Set font color
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
     * Get bold
     *
     * @return bool
     */
    public function isBold()
    {
        return $this->bold;
    }

    /**
     * Set bold
     *
     * @param bool $value
     * @return self
     */
    public function setBold($value = true)
    {
        $this->bold = $this->setBoolVal($value, $this->bold);

        return $this;
    }

    /**
     * Get italic
     *
     * @return bool
     */
    public function isItalic()
    {
        return $this->italic;
    }

    /**
     * Set italic
     *
     * @param bool $value
     * @return self
     */
    public function setItalic($value = true)
    {
        $this->italic = $this->setBoolVal($value, $this->italic);

        return $this;
    }

    /**
     * Get underline
     *
     * @return string
     */
    public function getUnderline()
    {
        return $this->underline;
    }

    /**
     * Set underline
     *
     * @param string $value
     * @return self
     */
    public function setUnderline($value = self::UNDERLINE_NONE)
    {
        $this->underline = $this->setNonEmptyVal($value, self::UNDERLINE_NONE);

        return $this;
    }

    /**
     * Get superscript
     *
     * @return bool
     */
    public function isSuperScript()
    {
        return $this->superScript;
    }

    /**
     * Set superscript
     *
     * @param bool $value
     * @return self
     */
    public function setSuperScript($value = true)
    {
        return $this->setPairedVal($this->superScript, $this->subScript, $value);
    }

    /**
     * Get subscript
     *
     * @return bool
     */
    public function isSubScript()
    {
        return $this->subScript;
    }

    /**
     * Set subscript
     *
     * @param bool $value
     * @return self
     */
    public function setSubScript($value = true)
    {
        return $this->setPairedVal($this->subScript, $this->superScript, $value);
    }

    /**
     * Get strikethrough
     *
     * @return bool
     */
    public function isStrikethrough()
    {
        return $this->strikethrough;
    }

    /**
     * Set strikethrough
     *
     * @param bool $value
     * @return self
     */
    public function setStrikethrough($value = true)
    {
        return $this->setPairedVal($this->strikethrough, $this->doubleStrikethrough, $value);
    }

    /**
     * Get double strikethrough
     *
     * @return bool
     */
    public function isDoubleStrikethrough()
    {
        return $this->doubleStrikethrough;
    }

    /**
     * Set double strikethrough
     *
     * @param bool $value
     * @return self
     */
    public function setDoubleStrikethrough($value = true)
    {
        return $this->setPairedVal($this->doubleStrikethrough, $this->strikethrough, $value);
    }

    /**
     * Get small caps
     *
     * @return bool
     */
    public function isSmallCaps()
    {
        return $this->smallCaps;
    }

    /**
     * Set small caps
     *
     * @param bool $value
     * @return self
     */
    public function setSmallCaps($value = true)
    {
        return $this->setPairedVal($this->smallCaps, $this->allCaps, $value);
    }

    /**
     * Get all caps
     *
     * @return bool
     */
    public function isAllCaps()
    {
        return $this->allCaps;
    }

    /**
     * Set all caps
     *
     * @param bool $value
     * @return self
     */
    public function setAllCaps($value = true)
    {
        return $this->setPairedVal($this->allCaps, $this->smallCaps, $value);
    }

    /**
     * Get foreground/highlight color
     *
     * @return ColorInterface
     */
    public function getFgColor(): ForegroundColor
    {
        return $this->fgColor;
    }

    /**
     * Set foreground/highlight color
     *
     * @param ForegroundColor $value
     * @return self
     */
    public function setFgColor(ForegroundColor $value)
    {
        $this->fgColor = $value;

        return $this;
    }

    /**
     * Get background
     *
     * @return string
     */
    public function getBgColor()
    {
        return $this->getChildStyleValue($this->shading, 'fill');
    }

    /**
     * Set background
     *
     * @param ColorInterface $value
     * @return self
     */
    public function setBgColor(ColorInterface $value = null): self
    {
        $this->setShading(array('fill' => $value));

        return $this;
    }

    /**
     * Get scale
     *
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set scale
     *
     * @param int $value
     * @return self
     */
    public function setScale($value = null)
    {
        $this->scale = $this->setIntVal($value, null);

        return $this;
    }

    /**
     * Get font spacing
     *
     * @return Absolute
     */
    public function getSpacing(): Absolute
    {
        return $this->spacing;
    }

    /**
     * Set font spacing
     *
     * @param Absolute $value
     * @return self
     */
    public function setSpacing(Absolute $value): self
    {
        $this->spacing = $value;

        return $this;
    }

    /**
     * Get font kerning
     *
     * @return int|float
     */
    public function getKerning()
    {
        return $this->kerning;
    }

    /**
     * Set font kerning
     *
     * @param int|float $value
     * @return self
     */
    public function setKerning($value = null)
    {
        $this->kerning = $this->setNumericVal($value, null);

        return $this;
    }

    /**
     * Get noProof (disables autocorrect)
     *
     * @return bool
     */
    public function isNoProof()
    {
        return $this->noProof;
    }

    /**
     * Set noProof (disables autocorrect)
     *
     * @param bool $value
     * @return $this
     */
    public function setNoProof($value = false)
    {
        $this->noProof = $value;

        return $this;
    }

    /**
     * Get line height
     *
     * @return int|float
     */
    public function getLineHeight()
    {
        return $this->getParagraph()->getLineHeight();
    }

    /**
     * Set lineheight
     *
     * @param int|float|string $value
     * @return self
     */
    public function setLineHeight($value)
    {
        $this->setParagraph(array('lineHeight' => $value));

        return $this;
    }

    /**
     * Get paragraph style
     *
     * @return \PhpOffice\PhpWord\Style\Paragraph
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }

    /**
     * Set Paragraph
     *
     * @param mixed $value
     * @return self
     */
    public function setParagraph($value = null)
    {
        $this->setObjectVal($value, 'Paragraph', $this->paragraph);

        return $this;
    }

    /**
     * Get rtl
     *
     * @return bool
     */
    public function isRTL()
    {
        return $this->rtl;
    }

    /**
     * Set rtl
     *
     * @param bool $value
     * @return self
     */
    public function setRTL($value = true)
    {
        $this->rtl = $this->setBoolVal($value, $this->rtl);

        return $this;
    }

    /**
     * Get shading
     *
     * @return \PhpOffice\PhpWord\Style\Shading
     */
    public function getShading()
    {
        return $this->shading;
    }

    /**
     * Set shading
     *
     * @param mixed $value
     * @return self
     */
    public function setShading($value = null)
    {
        $this->setObjectVal($value, 'Shading', $this->shading);

        return $this;
    }

    /**
     * Get language
     *
     * @return \PhpOffice\PhpWord\Style\Language
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set language
     *
     * @param mixed $value
     * @return self
     */
    public function setLang($value = null)
    {
        if (is_string($value) && $value != '') {
            $value = new Language($value);
        }
        $this->setObjectVal($value, 'Language', $this->lang);

        return $this;
    }

    /**
     * Get bold
     *
     * @deprecated 0.10.0
     *
     * @codeCoverageIgnore
     */
    public function getBold()
    {
        return $this->isBold();
    }

    /**
     * Get italic
     *
     * @deprecated 0.10.0
     *
     * @codeCoverageIgnore
     */
    public function getItalic()
    {
        return $this->isItalic();
    }

    /**
     * Get superscript
     *
     * @deprecated 0.10.0
     *
     * @codeCoverageIgnore
     */
    public function getSuperScript()
    {
        return $this->isSuperScript();
    }

    /**
     * Get subscript
     *
     * @deprecated 0.10.0
     *
     * @codeCoverageIgnore
     */
    public function getSubScript()
    {
        return $this->isSubScript();
    }

    /**
     * Get strikethrough
     *
     * @deprecated 0.10.0
     *
     * @codeCoverageIgnore
     */
    public function getStrikethrough()
    {
        return $this->isStrikethrough();
    }

    /**
     * Get paragraph style
     *
     * @deprecated 0.11.0
     *
     * @codeCoverageIgnore
     */
    public function getParagraphStyle()
    {
        return $this->getParagraph();
    }

    /**
     * Get hidden text
     *
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * Set hidden text
     *
     * @param bool $value
     * @return self
     */
    public function setHidden($value = true)
    {
        $this->hidden = $this->setBoolVal($value, $this->hidden);

        return $this;
    }

    /**
     * Get position
     *
     * @return Absolute
     */
    public function getPosition(): Absolute
    {
        if ($this->position === null) {
            $this->position = new Absolute(null);
        }

        return $this->position;
    }

    /**
     * Set position
     *
     * @param Absolute $value
     * @return self
     */
    public function setPosition(Absolute $value): self
    {
        $this->position = $value;

        return $this;
    }
}
