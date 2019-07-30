<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Lengths;

class Auto extends Length
{
    public function isSet(): bool
    {
        return true;
    }
}
