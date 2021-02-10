<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Required extends \Lepidosteus\Phupload\Rule
{
    protected bool $_required;

    public function __construct(bool $required = true)
    {
        $this->_required = $required;
    }

    public function validate(File $file): bool
    {
        $present = $file->submitted();
        return $this->_required == $present;
    }
}
