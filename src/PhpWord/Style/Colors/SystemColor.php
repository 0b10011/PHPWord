<?php

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception;

final class SystemColor implements ColorInterface
{
    /**
     * Taken from https://docs.microsoft.com/en-us/dotnet/api/system.windows.systemcolors?view=netframework-4.8
     * @var array
     */
    private static $allowedColors = array(
        'ActiveBorderBrush'                      => true,
        'ActiveBorderBrushKey'                   => true,
        'ActiveBorderColor'                      => true,
        'ActiveBorderColorKey'                   => true,
        'ActiveCaptionBrush'                     => true,
        'ActiveCaptionBrushKey'                  => true,
        'ActiveCaptionColor'                     => true,
        'ActiveCaptionColorKey'                  => true,
        'ActiveCaptionTextBrush'                 => true,
        'ActiveCaptionTextBrushKey'              => true,
        'ActiveCaptionTextColor'                 => true,
        'ActiveCaptionTextColorKey'              => true,
        'AppWorkspaceBrush'                      => true,
        'AppWorkspaceBrushKey'                   => true,
        'AppWorkspaceColor'                      => true,
        'AppWorkspaceColorKey'                   => true,
        'ControlBrush'                           => true,
        'ControlBrushKey'                        => true,
        'ControlColor'                           => true,
        'ControlColorKey'                        => true,
        'ControlDarkBrush'                       => true,
        'ControlDarkBrushKey'                    => true,
        'ControlDarkColor'                       => true,
        'ControlDarkColorKey'                    => true,
        'ControlDarkDarkBrush'                   => true,
        'ControlDarkDarkBrushKey'                => true,
        'ControlDarkDarkColor'                   => true,
        'ControlDarkDarkColorKey'                => true,
        'ControlLightBrush'                      => true,
        'ControlLightBrushKey'                   => true,
        'ControlLightColor'                      => true,
        'ControlLightColorKey'                   => true,
        'ControlLightLightBrush'                 => true,
        'ControlLightLightBrushKey'              => true,
        'ControlLightLightColor'                 => true,
        'ControlLightLightColorKey'              => true,
        'ControlTextBrush'                       => true,
        'ControlTextBrushKey'                    => true,
        'ControlTextColor'                       => true,
        'ControlTextColorKey'                    => true,
        'DesktopBrush'                           => true,
        'DesktopBrushKey'                        => true,
        'DesktopColor'                           => true,
        'DesktopColorKey'                        => true,
        'GradientActiveCaptionBrush'             => true,
        'GradientActiveCaptionBrushKey'          => true,
        'GradientActiveCaptionColor'             => true,
        'GradientActiveCaptionColorKey'          => true,
        'GradientInactiveCaptionBrush'           => true,
        'GradientInactiveCaptionBrushKey'        => true,
        'GradientInactiveCaptionColor'           => true,
        'GradientInactiveCaptionColorKey'        => true,
        'GrayTextBrush'                          => true,
        'GrayTextBrushKey'                       => true,
        'GrayTextColor'                          => true,
        'GrayTextColorKey'                       => true,
        'HighlightBrush'                         => true,
        'HighlightBrushKey'                      => true,
        'HighlightColor'                         => true,
        'HighlightColorKey'                      => true,
        'HighlightTextBrush'                     => true,
        'HighlightTextBrushKey'                  => true,
        'HighlightTextColor'                     => true,
        'HighlightTextColorKey'                  => true,
        'HotTrackBrush'                          => true,
        'HotTrackBrushKey'                       => true,
        'HotTrackColor'                          => true,
        'HotTrackColorKey'                       => true,
        'InactiveBorderBrush'                    => true,
        'InactiveBorderBrushKey'                 => true,
        'InactiveBorderColor'                    => true,
        'InactiveBorderColorKey'                 => true,
        'InactiveCaptionBrush'                   => true,
        'InactiveCaptionBrushKey'                => true,
        'InactiveCaptionColor'                   => true,
        'InactiveCaptionColorKey'                => true,
        'InactiveCaptionTextBrush'               => true,
        'InactiveCaptionTextBrushKey'            => true,
        'InactiveCaptionTextColor'               => true,
        'InactiveCaptionTextColorKey'            => true,
        'InactiveSelectionHighlightBrush'        => true,
        'InactiveSelectionHighlightBrushKey'     => true,
        'InactiveSelectionHighlightTextBrush'    => true,
        'InactiveSelectionHighlightTextBrushKey' => true,
        'InfoBrush'                              => true,
        'InfoBrushKey'                           => true,
        'InfoColor'                              => true,
        'InfoColorKey'                           => true,
        'InfoTextBrush'                          => true,
        'InfoTextBrushKey'                       => true,
        'InfoTextColor'                          => true,
        'InfoTextColorKey'                       => true,
        'MenuBarBrush'                           => true,
        'MenuBarBrushKey'                        => true,
        'MenuBarColor'                           => true,
        'MenuBarColorKey'                        => true,
        'MenuBrush'                              => true,
        'MenuBrushKey'                           => true,
        'MenuColor'                              => true,
        'MenuColorKey'                           => true,
        'MenuHighlightBrush'                     => true,
        'MenuHighlightBrushKey'                  => true,
        'MenuHighlightColor'                     => true,
        'MenuHighlightColorKey'                  => true,
        'MenuTextBrush'                          => true,
        'MenuTextBrushKey'                       => true,
        'MenuTextColor'                          => true,
        'MenuTextColorKey'                       => true,
        'ScrollBarBrush'                         => true,
        'ScrollBarBrushKey'                      => true,
        'ScrollBarColor'                         => true,
        'ScrollBarColorKey'                      => true,
        'WindowBrush'                            => true,
        'WindowBrushKey'                         => true,
        'WindowColor'                            => true,
        'WindowColorKey'                         => true,
        'WindowFrameBrush'                       => true,
        'WindowFrameBrushKey'                    => true,
        'WindowFrameColor'                       => true,
        'WindowFrameColorKey'                    => true,
        'WindowTextBrush'                        => true,
        'WindowTextBrushKey'                     => true,
        'WindowTextColor'                        => true,
        'WindowTextColorKey'                     => true,
    );

    private $color;

    public function __construct(string $color)
    {
        if (!static::isValid($color)) {
            throw new Exception(sprintf("Provided system color must be a valid system color. '%s' provided. Allowed: %s`", $color, implode(', ', self::$allowedColors)));
        }

        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function toRgb(): array
    {
        throw new Exception('Cannot convert system color to RGB');
    }

    public function toHex(bool $includeHash = false): string
    {
        throw new Exception('Cannot convert system color to hex');
    }

    public static function isValid(string $color): bool
    {
        return array_key_exists($color, self::$allowedColors);
    }
}
