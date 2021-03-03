<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class Upload
{
    protected array $_errors;
    protected ?File $_file;

    public function __construct(?File $file, array $errors)
    {
        $this->_file = $file;
        $this->_errors = $errors;
    }

    public function errors(): array
    {
        return $this->_errors;
    }

    public function file(): ?File
    {
        return $this->_file;
    }

    public function has_errors()
    {
        return !empty($this->_errors);
    }
    
    public function has_file()
    {
        return !\is_null($this->_file);
    }
}