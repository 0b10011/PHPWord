<?php

namespace PhpOffice\PhpWord\Style\Colors;

class Color
{
    public static function translate($value = null): ColorInterface
    {
        if ($value instanceof ColorInterface) {
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
