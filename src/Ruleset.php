<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class Ruleset
{
    /** @var Rule[] */
    protected array $_rules;
    
    public function __construct()
    {
        $this->_rules = [];
    }

    /** @return Rule[] */
    public function validate(File $file, bool $stop_on_first_error = true): array
    {
        $failed_rules = [];
        foreach ($this->_rules as $rule) {
            if (!$rule->validate($file)) {
                $failed_rules[$rule];
                if ($stop_on_first_error) {
                    break;
                }
            }
        }
        return $failed_rules;
    }
}