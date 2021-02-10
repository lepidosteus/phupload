<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

// TODO locale detection + setlocale 
// TODO extension
// TOOD manipulation
// TODO realpath

class File
{
    protected Path $_path;
    protected string $_name;
    protected string $_field;
    protected int $_size;

    public function __construct(string $field)
    {
        $this->_field = $field;

        $this->_path = $path;
        $this->_name = $name;
    }
    
    public function move()
    {
        //
    }

    public function delete()
    {
        unlink()
    }

    public function size()
    {
        //
    }

    public function name()
    {
        return $this->_name;
    }

    public function field()
    {
        return $this->_field;
    }
}
