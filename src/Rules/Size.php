<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class Size extends \Lepidosteus\Phupload\Rule
{
    const MIN = 'min';
    const MAX = 'max';

    protected int $_size;
    protected string $_type;

    public function __construct(string $type, $size)
    {
        if (!\is_string($size)) {
            $size = (string)$size;
        }
        if (preg_match('/^\d+G$/i', $size)) {
            $this->_size = (int)substr(0, -1, $size) * 1024 * 1024 * 1024;
        } elseif (preg_match('/^\d+M$/i', $size)) {
            $this->_size = (int)substr(0, -1, $size) * 1024 * 1024;
        } elseif (preg_match('/^\d+K$/i', $size)) {
            $this->_size = (int)substr(0, -1, $size) * 1024;
        } elseif (preg_match('/^\d+$/', $size)) {
            $this->_size = (int)$size;
        } else {
            throw new \InvalidArgumentException('Invalid size given');
        }

        if (!\in_array($type, [self::MIN, self::MAX])) {
            throw new \InvalidArgumentException('Invalid type given');    
        }

        $this->_type = $type;
    }

    public function validate(\Lepidosteus\Phupload\File $file): bool
    {
        if ($this->_type == self::MAX) {
            return $file->size() <= $this->_size;
        } else {
            return $file->size() >= $this->_size;
        }
    }
}
