<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

abstract class Core extends \Lepidosteus\Phupload\Rule
{
    abstract public function validate(?\Lepidosteus\Phupload\File $file): bool;

    final public function abort_if_error(): bool
    {
        return true;
    }
}
