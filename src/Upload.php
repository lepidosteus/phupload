<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class Upload
{
    protected Ruleset $_ruleset;
    protected array $_errors;
    protected File $_file;

    static public function create()
    {
        return new static();
    }

    public function __construct()
    {
        $this->_ruleset = [];
        $this->required(true);
    }

    public function validate(string $field, array $source = null): bool
    {
        $source ??= $_FILES;
        $this->_file = self::files_to_file($source, $field);
        $this->_errors = $this->_ruleset->validate($this->_file);

        return empty($this->_errors);
    }

    public function errors(): array
    {
        return $this->_errors;
    }

    public function file(): File
    {
        return $this->_file;
    }

    public function required(bool $required = true): self
    {
        $this->_ruleset[0] = new Rules\Required($required);
        return $this;
    }

    public function min_size(int $min_size): self
    {
        $this->_ruleset[] = new Rules\MinSize($min_size);
        return $this;
    }

    public function max_size(int $max_size): self
    {
        $this->_ruleset[] = new Rules\MaxSize($max_size);
        return $this;
    }

    public function size(int $min_size, int $max_size): self
    {
        $this->min_size($min_size);
        $this->max_size($max_size);
        return $this;
    }

    public function extension($allowed_extensions): self
    {
        if (!\is_array($allowed_extensions)) {
            $allowed_extensions = [$allowed_extensions];
        }
        $this->_ruleset[] = new Rules\Extensions($allowed_extensions);
        return $this;
    }

    public function mime($allowed_mimes): self
    {
        if (!\is_array($allowed_mimes)) {
            $allowed_mimes = [$allowed_mimes];
        }
        $this->_ruleset[] = new Rules\Mimes($allowed_mimes);
        return $this;
    }

    /** @param Rule|Closure|callable $rule */
    public function add_rule($rule): self
    {
        if ($rule instanceof Rule) {
            $this->_ruleset[] = $rule;
        } elseif ($rule instanceof \Closure) {
            $this->_ruleset[] = new Rules\Custom($rule);
        } elseif (\is_callable($rule)) {
            $this->_ruleset[] = new Rules\Custom(\Closure::fromCallable($rule));
        } else {
            throw new \InvalidArgumentException('Only instances of Rules or closures can be used as upload rules');
        }

        return $this;
    }
}
