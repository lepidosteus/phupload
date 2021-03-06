<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Required extends Core
{
    protected bool $_required;

    public function __construct(bool $required = true)
    {
        $this->_required = $required;
    }

    public function validate(?\Lepidosteus\Phupload\File $file): bool
    {
        if ($this->_required) {
            return !\is_null($file);
        }
        return true;
    }
}
