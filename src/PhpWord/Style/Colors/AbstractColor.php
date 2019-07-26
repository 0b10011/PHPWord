<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception\Exception;

abstract class AbstractColor
{
    final public function getHexOrName(bool $includeHash = false)
    {
        if ($this instanceof NamedColorInterface) {
            return $this->getName();
        } elseif ($this instanceof StaticColorInterface) {
            return $this->toHex($includeHash);
        }
        throw new Exception('All colors must implement NamedAbstractColor or StaticAbstractColor.');
    }
}
