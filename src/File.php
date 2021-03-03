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

    static public function create()
    {
        //
    }

    public function __construct(string $field)
    {
        $this->_field = $field;

        $this->_path = $path;
        $this->_name = $name;
    }

    //public function create_from_files(array )
    
    public function move()
    {
        //
    }

    public function delete()
    {
        unlink()
    }

    public function size(): int
    {
        return
    }

    public function exists(): bool
    {
        return \file_exists($this->_path);
    }

    public function name(): string
    {
        return $this->_name;
    }

    public function extension(): string
    {
        return $this->_path->extension();
    }

    public function field()
    {
        return $this->_field;
    }
}
