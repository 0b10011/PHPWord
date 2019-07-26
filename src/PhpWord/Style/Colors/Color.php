<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

final class Color
{
    final public function __construct()
    {
        throw new Exception('Color cannot be instantiated');
    }

    public static function translate($value = null): AbstractColor
    {
        if ($value instanceof AbstractColor) {
            return $value;
        } elseif ($value === null || $value === '' || $value === 'auto') {
            return new Hex(null);
        } elseif (is_string($value)) {
            if (Hex::isValid($value)) {
                return new Hex($value);
            } elseif (SystemColor::isValid($value)) {
                return new SystemColor($value);
            } elseif (ForegroundColor::isValid($value)) {
                return new ForegroundColor($value);
            }
        }

        trigger_error(sprintf('Color `%s` is not a valid color', $value), E_USER_WARNING);

        return new Hex(null);
    }
}
