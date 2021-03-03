<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Extensions extends \Lepidosteus\Phupload\Rule
{
    protected array  $_allowed_extensions;

    public function __construct(array $allowed_extensions)
    {
        $this->_allowed_extensions = array_map('strtolower', $allowed_extensions);
    }

    public function validate(\Lepidosteus\Phupload\File $file): bool
    {
        return in_array(strtolower($file->extension()), $this->_allowed_extensions);
    }
}
