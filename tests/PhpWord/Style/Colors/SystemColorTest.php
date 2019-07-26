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
 * @coversDefaultClass \PhpOffice\PhpWord\Style\Colors\SystemColor
 */
class SystemColorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Provided system color must be a valid system color. 'FakeColor' provided. Allowed:
     */
    public function testConversions()
    {
        // Prepare test values [ original, expected ]
        $values = array(
            'ActiveBorderBrush',
            'ActiveBorderBrushKey',
            'ActiveBorderColor',
            'ActiveBorderColorKey',
            'ActiveCaptionBrush',
            'ActiveCaptionBrushKey',
            'ActiveCaptionColor',
            'ActiveCaptionColorKey',
            'ActiveCaptionTextBrush',
            'ActiveCaptionTextBrushKey',
            'ActiveCaptionTextColor',
            'ActiveCaptionTextColorKey',
            'AppWorkspaceBrush',
            'AppWorkspaceBrushKey',
            'AppWorkspaceColor',
            'AppWorkspaceColorKey',
            'ControlBrush',
            'ControlBrushKey',
            'ControlColor',
            'ControlColorKey',
            'ControlDarkBrush',
            'ControlDarkBrushKey',
            'ControlDarkColor',
            'ControlDarkColorKey',
            'ControlDarkDarkBrush',
            'ControlDarkDarkBrushKey',
            'ControlDarkDarkColor',
            'ControlDarkDarkColorKey',
            'ControlLightBrush',
            'ControlLightBrushKey',
            'ControlLightColor',
            'ControlLightColorKey',
            'ControlLightLightBrush',
            'ControlLightLightBrushKey',
            'ControlLightLightColor',
            'ControlLightLightColorKey',
            'ControlTextBrush',
            'ControlTextBrushKey',
            'ControlTextColor',
            'ControlTextColorKey',
            'DesktopBrush',
            'DesktopBrushKey',
            'DesktopColor',
            'DesktopColorKey',
            'GradientActiveCaptionBrush',
            'GradientActiveCaptionBrushKey',
            'GradientActiveCaptionColor',
            'GradientActiveCaptionColorKey',
            'GradientInactiveCaptionBrush',
            'GradientInactiveCaptionBrushKey',
            'GradientInactiveCaptionColor',
            'GradientInactiveCaptionColorKey',
            'GrayTextBrush',
            'GrayTextBrushKey',
            'GrayTextColor',
            'GrayTextColorKey',
            'HighlightBrush',
            'HighlightBrushKey',
            'HighlightColor',
            'HighlightColorKey',
            'HighlightTextBrush',
            'HighlightTextBrushKey',
            'HighlightTextColor',
            'HighlightTextColorKey',
            'HotTrackBrush',
            'HotTrackBrushKey',
            'HotTrackColor',
            'HotTrackColorKey',
            'InactiveBorderBrush',
            'InactiveBorderBrushKey',
            'InactiveBorderColor',
            'InactiveBorderColorKey',
            'InactiveCaptionBrush',
            'InactiveCaptionBrushKey',
            'InactiveCaptionColor',
            'InactiveCaptionColorKey',
            'InactiveCaptionTextBrush',
            'InactiveCaptionTextBrushKey',
            'InactiveCaptionTextColor',
            'InactiveCaptionTextColorKey',
            'InactiveSelectionHighlightBrush',
            'InactiveSelectionHighlightBrushKey',
            'InactiveSelectionHighlightTextBrush',
            'InactiveSelectionHighlightTextBrushKey',
            'InfoBrush',
            'InfoBrushKey',
            'InfoColor',
            'InfoColorKey',
            'InfoTextBrush',
            'InfoTextBrushKey',
            'InfoTextColor',
            'InfoTextColorKey',
            'MenuBarBrush',
            'MenuBarBrushKey',
            'MenuBarColor',
            'MenuBarColorKey',
            'MenuBrush',
            'MenuBrushKey',
            'MenuColor',
            'MenuColorKey',
            'MenuHighlightBrush',
            'MenuHighlightBrushKey',
            'MenuHighlightColor',
            'MenuHighlightColorKey',
            'MenuTextBrush',
            'MenuTextBrushKey',
            'MenuTextColor',
            'MenuTextColorKey',
            'ScrollBarBrush',
            'ScrollBarBrushKey',
            'ScrollBarColor',
            'ScrollBarColorKey',
            'WindowBrush',
            'WindowBrushKey',
            'WindowColor',
            'WindowColorKey',
            'WindowFrameBrush',
            'WindowFrameBrushKey',
            'WindowFrameColor',
            'WindowFrameColorKey',
            'WindowTextBrush',
            'WindowTextBrushKey',
            'WindowTextColor',
            'WindowTextColorKey',

            'FakeColor',
        );
        // Conduct test
        foreach ($values as $value) {
            $message = $value . ' should be a valid color';
            $result = new SystemColor($value);
            $this->assertEquals($value, $result->getName(), $message);
            $this->assertEquals($value, $result->toHexOrName(), $message);
        }
    }
}
