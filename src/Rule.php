<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

abstract class Rule
{
    abstract public function validate(File $file): bool;
}