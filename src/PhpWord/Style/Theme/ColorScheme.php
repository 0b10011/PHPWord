<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Theme;

use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\Style\Colors\AbstractColor;
use PhpOffice\PhpWord\Style\Colors\SystemColor;

class ColorScheme
{
    /**
     * Should match list in
     * \PhpOffice\PhpWord\Style\Colors\ThemeColor
     * @var array
     */
    private $colorScheme = array(
        'dk1'      => null,
        'dk2'      => null,
        'lt1'      => null,
        'lt2'      => null,
        'accent1'  => null,
        'accent2'  => null,
        'accent3'  => null,
        'accent4'  => null,
        'accent5'  => null,
        'accent6'  => null,
        'hlink'    => null,
        'folHlink' => null,
    );

    public function __construct(array $colorScheme)
    {
        if (count($colorScheme) !== count($this->colorScheme)) {
            throw new Exception(sprintf('%s colors expected, but %s colors provided', count($this->colorScheme), count($colorScheme)));
        }

        foreach ($this->colorScheme as $name => $null) {
            if (!array_key_exists($name, $colorScheme)) {
                throw new Exception(sprintf("Missing '$name' from provided color scheme"));
            }

            $color = $colorScheme[$name];
            if (!($color instanceof AbstractColor) && !($color instanceof SystemColor)) {
                throw new Exception(sprintf("Provided color for '%s' must be an instance of '%s', '%s' provided", $name, AbstractColor::class, get_class($color)));
            }

            $this->colorScheme[$name] = $color;
        }
    }

    public function getColors(): array
    {
        $colors = array();
        foreach ($this->colorScheme as $name => $color) {
            $colors[$name] = clone $color;
        }

        return $colors;
    }

    public function getColor(string $name): AbstractColor
    {
        if (!array_key_exists($name, $this->colorScheme)) {
            throw new Exception(sprintf("No color exists for '$name'"));
        }

        return clone $this->colorScheme[$name];
    }
}
