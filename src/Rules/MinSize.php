<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class MinSize extends \Lepidosteus\Phupload\Rule
{
    protected int $_min_size;

    public function __construct(int $min_size)
    {
        if ($min_size < 0) {
            $min_size = 0;
        }
        $this->_min_size = $min_size;
    }

    public function validate(File $file): bool
    {
        return $file->size() >= $this->_min_size;
    }
}
