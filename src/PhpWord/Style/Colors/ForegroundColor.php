<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception\Exception;

final class ForegroundColor extends AbstractColor implements StaticColorInterface, NamedColorInterface
{
    private static $allowedColors = array(
        'yellow'      => 'FF0000',
        'green'       => '00FF00',
        'cyan'        => '00FFFF',
        'magenta'     => 'FF00FF',
        'blue'        => '0000FF',
        'red'         => 'FF0000',
        'darkBlue'    => '000080',
        'darkCyan'    => '008080',
        'darkGreen'   => '008000',
        'darkMagenta' => '800080',
        'darkRed'     => '800000',
        'darkYellow'  => '808000',
        'darkGray'    => '808080',
        'lightGray'   => 'C0C0C0',
        'black'       => '000000',
    );

    private $color;

    public function __construct(string $color = null)
    {
        if ($color !== null) {
            $color = strtolower($color);

            if (!static::isValid($color)) {
                throw new Exception(sprintf("Provided color must be a valid foreground color. '%s' provided. Allowed: %s`", $color, implode(', ', self::$allowedColors)));
            }
        }

        $this->color = $color;
    }

    public function getName()
    {
        return $this->color;
    }

    public function toRgb()
    {
        if ($this->color === null) {
            return null;
        }

        $rgb = array();
        foreach (str_split(self::$allowedColors[$this->color], 2) as $c) {
            $rgb[] = hexdec($c);
        }

        return $rgb;
    }

    public function toHex(bool $includeHash = false)
    {
        if ($this->color === null) {
            return null;
        }

        return ($includeHash ? '#' : '') . self::$allowedColors[$this->color];
    }

    public static function isValid(string $color): bool
    {
        return array_key_exists($color, self::$allowedColors);
    }

    public static function translate($value = null): self
    {
        if ($value instanceof self) {
            return $value;
        } elseif ($value === null || $value === '' || $value === 'auto') {
            return new self(null);
        } elseif (is_string($value) && self::isValid($value)) {
            return new self($value);
        }

        trigger_error(sprintf('Foreground color `%s` is not a valid color', $value), E_USER_WARNING);

        return new self(null);
    }
}
