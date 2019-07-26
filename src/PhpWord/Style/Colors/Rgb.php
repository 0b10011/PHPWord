<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception;

class Rgb extends AbstractColor implements StaticColorInterface
{
    private $rgb;

    public function __construct(int $red, int $green, int $blue)
    {
        if ($red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255) {
            throw new Exception(sprintf('Provided values must be 0–255. Provided `Rgb(%s, %s, %s)`', $red, $green, $blue));
        }

        $this->rgb = array($red, $green, $blue);
    }

    public function toRgb(): array
    {
        return $this->rgb;
    }

    public function toHex(bool $includeHash = false): string
    {
        return sprintf('%s%02X%02X%02X', ($includeHash ? '#' : ''), $red, $green, $blue);
    }
}
