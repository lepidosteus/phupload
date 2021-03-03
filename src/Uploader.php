<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class Uploader
{
    protected Ruleset $_ruleset;

    static public function create()
    {
        return new static();
    }

    public function __construct()
    {
        $this->_ruleset = new Ruleset();
    }

    public function validate(string $field, array $source = null): Upload
    {
        $source ??= $_FILES;

        $file = File::create($source, $field);
        
        $errors = $this->_ruleset->validate($file);

        $result = new Upload($file, $errors);

        return $result;
    }

    public function required(bool $required = true): self
    {
        $this->_ruleset->required($required);
        return $this;
    }

    public function min_size($min_size): self
    {
        $this->_ruleset->push(new Rules\Size(Rules\Size::MIN, $min_size));
        return $this;
    }

    public function max_size($max_size): self
    {
        $this->_ruleset->push(new Rules\Size(Rules\Size::MAX, $max_size));
        return $this;
    }

    public function size($min_size, $max_size): self
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
        $this->_ruleset->push(new Rules\Extensions($allowed_extensions));
        return $this;
    }

    public function mime($allowed_mimes): self
    {
        if (!\is_array($allowed_mimes)) {
            $allowed_mimes = [$allowed_mimes];
        }
        $this->_ruleset->push(new Rules\Mimes($allowed_mimes));
        return $this;
    }

    /** @param Rule|Closure|callable $rule */
    public function add_rule($rule): self
    {
        if ($rule instanceof Rule) {
            $this->_ruleset->push($rule);
        } elseif ($rule instanceof \Closure) {
            $this->_ruleset->push(new Rules\Custom($rule));
        } elseif (\is_callable($rule)) {
            $this->_ruleset->push(new Rules\Custom(\Closure::fromCallable($rule)));
        } else {
            throw new \InvalidArgumentException('Only instances of Rules or closures can be used as upload rules');
        }

        return $this;
    }
}
