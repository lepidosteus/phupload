<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Custom extends \Lepidosteus\Phupload\Rule
{
    protected \Closure $_cb;

    public function __construct(\Closure $cb)
    {
        $this->_cb = $cb;
    }

    public function validate(File $file): bool
    {
        return ($this->_cb)($file);
    }
}
