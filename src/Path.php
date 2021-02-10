<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

// TODO locale detection + setlocale 
// TODO extension
// TOOD manipulation
// TODO realpath

class Path
{
    protected string $_path;
    protected array $_pathinfo;
    protected string $_ds;

    public function __construct(string $path)
    {
        if (!ctype_print($path)) {
            throw new \InvalidArgumentException('Argument $path must be valid path string, illegal characters detected');
        }
        $this->_path = \preg_replace('#'.quotemeta(\DIRECTORY_SEPARATOR).'{2,}#', \DIRECTORY_SEPARATOR, $path);
        $this->_pathinfo = [];
    }

    public function __toString()
    {
        return $this->_path;
    }

    public function pathinfo()
    {
        if (!$this->_pathinfo) {
            $this->_pathinfo = \pathinfo($this->_path);
        }
        $this->_pathinfo['extension'] ??= '';
        return $this->_pathinfo;
    }

    public function dirname()
    {
        return $this->pathinfo()['dirname'];
    }

    public function basename()
    {
        return $this->pathinfo()['basename'];
    }

    public function extension()
    {
        return $this->pathinfo()['extension'];
    }

    public function filename()
    {
        return $this->pathinfo()['filename'];
    }
}
