<?php

namespace PhpOffice\PhpWord\Style\Colors;

interface ColorInterface
{
    /**
     * @return ?string
     */
    public function getColor();

    public function toRgb();

    public function toHex(bool $includeHash = false);
}
