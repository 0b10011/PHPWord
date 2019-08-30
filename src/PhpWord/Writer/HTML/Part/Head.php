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

namespace PhpOffice\PhpWord\Writer\HTML\Part;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;
use PhpOffice\PhpWord\Writer\HTML\Style\Font as FontStyleWriter;
use PhpOffice\PhpWord\Writer\HTML\Style\Generic as GenericStyleWriter;
use PhpOffice\PhpWord\Writer\HTML\Style\Paragraph as ParagraphStyleWriter;

/**
 * RTF head part writer
 *
 * @since 0.11.0
 */
class Head extends AbstractPart
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $docProps = $this->getParentWriter()->getPhpWord()->getDocInfo();
        $propertiesMapping = array(
            'creator'     => 'author',
            'title'       => '',
            'description' => '',
            'subject'     => '',
            'keywords'    => '',
            'category'    => '',
            'company'     => '',
            'manager'     => '',
        );
        $title = $docProps->getTitle();
        $title = ($title != '') ? $title : 'PHPWord';

        $html = '';

        $html .= '<head>' . PHP_EOL;
        $html .= '<meta charset="UTF-8" />' . PHP_EOL;
        $html .= '<title>' . (Settings::isOutputEscapingEnabled() ? $this->escaper->escapeHtml($title) : $title) . '</title>' . PHP_EOL;
        foreach ($propertiesMapping as $key => $name) {
            $name = ($name == '') ? $key : $name;
            $method = 'get' . $key;

            $content = $docProps->$method();
            if ($content === '') {
                continue;
            }

            if (Settings::isOutputEscapingEnabled()) {
                $content = $this->escaper->escapeHtmlAttr($content);
            }

            $html .= '<meta name="' . $name . '"'
                      . ' content="' . $content . '"'
                      . ' />' . PHP_EOL;
        }
        $html .= $this->writeStyles();
        $html .= '</head>' . PHP_EOL;

        return $html;
    }

    /**
     * Get styles
     *
     * @return string
     */
    private function writeStyles()
    {
        // Stylesheets with the title "PHPWord Base Styles"
        // are ignored during read
        // so we can make the HTML document look nice
        // without interfering with the styles
        // when we import.
        $css = '<style title="PHPWord Base Styles">' . PHP_EOL;

        // Default styles
        $defaultStyles = array(
            '*' => array(
                'font-family' => Settings::getDefaultFontName(),
                'font-size'   => Settings::getDefaultFontSize()->toInt('pt') . 'pt',
            ),
            'a.NoteRef' => array(
                'text-decoration' => 'none',
            ),
            'hr' => array(
                'height'     => '1px',
                'padding'    => '0',
                'margin'     => '1em 0',
                'border'     => '0',
                'border-top' => '1px solid #CCC',
            ),
            'table' => array(
                'border'         => '1px solid black',
                'border-spacing' => '0px',
                'width '         => '100%',
            ),
            'td' => array(
                'border' => '1px solid black',
            ),
        );
        foreach ($defaultStyles as $selector => $style) {
            $styleWriter = new GenericStyleWriter($style);
            $css .= $selector . ' {' . $styleWriter->write() . '}' . PHP_EOL;
        }

        // Custom styles
        $customStyles = Style::getStyles();
        if (is_array($customStyles)) {
            foreach ($customStyles as $name => $style) {
                if ($style instanceof Font) {
                    $styleWriter = new FontStyleWriter($style);
                    if ($style->getStyleType() == 'title') {
                        $level = max(1, min(6, (int) str_replace('Heading_', '', $name)));
                        $name = 'h' . $level;
                    } else {
                        $name = '.' . $name;
                    }
                    $css .= "{$name} {" . $styleWriter->write() . '}' . PHP_EOL;
                } elseif ($style instanceof Paragraph) {
                    $styleWriter = new ParagraphStyleWriter($style);
                    $name = '.' . $name;
                    $css .= "{$name} {" . $styleWriter->write() . '}' . PHP_EOL;
                }
            }
        }
        $css .= '</style>' . PHP_EOL;

        return $css;
    }
}
