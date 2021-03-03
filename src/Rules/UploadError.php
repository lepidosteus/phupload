<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload\Rules;

class UploadError extends Core
{
    protected bool $_required;

    public function __construct(bool $required = true)
    {
        $this->_required = $required;
    }

    public function validate(?\Lepidosteus\Phupload\File $file): bool
    {
        switch ($file->error()) {
            case UPLOAD_ERR_OK:
                return true;
            case UPLOAD_ERR_NO_FILE:
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
            default:
                return false;
        }
    }
}
