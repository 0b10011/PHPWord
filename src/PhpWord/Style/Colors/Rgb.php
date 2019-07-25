<?php

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception;

class Rgb implements ColorInterface
{
    private $hex;

    public function __construct(int $red, int $green, int $blue)
    {
        if ($red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255) {
            throw new Exception(sprintf('Provided values must be 0–255. Provided `Rgb(%s, %s, %s)`', $red, $green, $blue));
        }

        // FIXME http://officeopenxml.com/WPtableCellProperties-Borders.php specifies no #; not sure if this applies everywhere for color
        $this->hex = sprintf('%02X%02X%02X', $red, $green, $blue);
    }

    public function getColor(): string
    {
        return $this->hex;
    }

    public function toRgb(): array
    {
        $rgb = array();
        foreach (str_split($this->hex, 2) as $c) {
            $rgb[] = hexdec($c);
        }

        return $rgb;
    }

    public function toHex(bool $includeHash = false): string
    {
        return ($includeHash ? '#' : '') . $this->hex;
    }
}
