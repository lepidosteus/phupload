<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class File
{
    protected string $_field;

    protected string $_files_name; 
    protected string $_files_type; 
    protected int $_files_size; 
    protected string $_files_tmp_name; 
    protected int $_files_error; 

    static public function create(array $source, string $field): ?self
    {
        if (!isset($source[$field]) || !\is_array($source[$field])) {
            return null;
        }

        $file = $source[$field];

        foreach (['name', 'type', 'size', 'tmp_name', 'error'] as $key) {
            if (!isset($file[$key])) {
                return null;
            }
        }

        if ($file['error'] == UPLOAD_ERR_NO_FILE) {
            return null;
        }

        return new self($field, $file);
    }

    public function __construct(string $field, array $data)
    {
        foreach (['name', 'type', 'size', 'tmp_name', 'error'] as $key) {
            if (!isset($data[$key])) {
                throw new \InvalidArgumentException('Phupload\File must receive a valid file array entry');
            }
        }

        $this->_field = $field;

        $this->_files_name = $data['name'];
        $this->_files_type = $data['type'];
        $this->_files_size = $data['size'];
        $this->_files_tmp_name = $data['tmp_name'];
        $this->_files_error = $data['error'];
    }

    public function error(): int
    {
        return $this->_files_error;
    }

    public function size(): int
    {
        return $this->_files_size;
    }

    public function path(): Path
    {
        return new Path($this->_files_tmp_name);
    }

    public function mime(): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, (string)$this->path());
        finfo_close($finfo);
        return $mime;
    }

    public function name(): Path
    {
        return new Path($this->_files_name);
    }

    public function extension(): string
    {
        return $this->name()->extension();
    }

    public function size_pretty(): string
    {
        $size = $this->size();
        $KB = 1024;
        $MB = $KB*1024;
        $GB = $MB*1024;
        if (($size / $GB) > 1) {
            return (string)round($size / $GB, 2).'GB';
        }
        if (($size / $MB) > 1) {
            return (string)round($size / $MB, 2).'MB';
        }
        if (($size / $KB) > 1) {
            return (string)round($size / $KB, 2).'KB';
        }
        return (string)$size;
    }

    public function move(string $destination_folder, string $filename, bool $allow_overwrite = false): bool
    {
        $filename = strtr($filename, ["/" => '', "\\" => '']);
        $destination_path = (string)new Path($destination_folder.$filename);
        if (\file_exists($destination_path) && !$allow_overwrite) {
            return false;
        }
        return move_uploaded_file((string)$this->path(), $destination_path);
    }
}
