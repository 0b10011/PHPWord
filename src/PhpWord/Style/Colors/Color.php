<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception\Exception;

final class Color
{
    final public function __construct()
    {
        throw new Exception('Color cannot be instantiated');
    }

    public static function fromMixed($value = null): AbstractColor
    {
        if ($value instanceof AbstractColor) {
            return $value;
        } elseif ($value === null || $value === '' || $value === 'auto') {
            return new Hex(null);
        } elseif (is_string($value)) {
            if (Hex::isValid($value)) {
                return new Hex($value);
            } elseif (ThemeColor::isValid($value)) {
                return new ThemeColor($value);
            }
        }

        trigger_error(sprintf('Color `%s` is not a valid color', $value), E_USER_WARNING);

        return new Hex(null);
    }
}
