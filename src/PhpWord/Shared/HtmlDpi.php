<?php

namespace PhpOffice\PhpWord\Shared;

use PhpOffice\PhpWord\Style\Lengths\Dpi;

class HtmlDpi implements Dpi
{
    /**
     * @see https://www.w3.org/TR/css3-values/#compat
     * @return float
     */
    public function getDpi(): float
    {
        return 96;
    }
}
