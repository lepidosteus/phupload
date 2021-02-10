<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Mimes extends \Lepidosteus\Phupload\Rule
{
    protected array $_allowed_mimes;

    public function __construct(array $allowed_mimes)
    {
        $this->_allowed_mimes = array_map('strtolower', $allowed_mimes);
    }

    public function validate(File $file): bool
    {
        return in_array(strtolower($file->mime()), $this->_allowed_mimes);
    }
}
