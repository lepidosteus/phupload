<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class MaxSize extends \Lepidosteus\Phupload\Rule
{
    protected int $_max_size;

    public function __construct(int $max_size)
    {
        if ($max_size < 0) {
            $max_size = 0;
        }
        $this->_max_size = $max_size;
    }

    public function validate(File $file): bool
    {
        return $file->size() <= $this->_max_size;
    }
}
