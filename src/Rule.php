<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

abstract class Rule
{
    protected string $_error;

    abstract public function validate(File $file): bool;
    
    public function __toString(): string
    {
        if (!empty($this->_error)) {
            return $this->_error;
        }
        return get_class($this);
    }

    public function abort_if_error(): bool
    {
        return false;
    }
}