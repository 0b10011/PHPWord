<?php
declare(strict_types=1);

namespace PhpOffice\PhpWord\Style\Colors;

use PhpOffice\PhpWord\Exception\Exception;

abstract class AbstractColor
{
    final public function toHexOrName(bool $includeHash = false)
    {
        if ($this instanceof NamedColorInterface) {
            return $this->getName();
        }
        if ($this instanceof StaticColorInterface) {
            return $this->toHex($includeHash);
        }
        throw new Exception(sprintf('All colors must implement NamedAbstractColor or StaticAbstractColor. \'%s\' does not implement either.', get_class($this)));
    }
}
