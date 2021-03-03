<?php
declare(strict_types = 1);

namespace Lepidosteus\Phupload;

class Ruleset
{
    const RULE_IDX_REQUIRED = 0;
    const RULE_IDX_UPLOADERROR = 1;

    /** @var Rule[] */
    protected array $_rules;
    
    public function __construct()
    {
        $this->_rules = [
            self::RULE_IDX_REQUIRED => new Rules\Required(true),
            self::RULE_IDX_UPLOADERROR => new Rules\UploadError(),
        ];
    }

    /** @return Rule[] */
    public function validate(?File $file, bool $stop_on_first_error = true): array
    {
        $failed_rules = [];
        foreach ($this->_rules as $rule) {
            if (!$rule->validate($file)) {
                $failed_rules[] = $rule;
                if ($rule->abort_if_error()) {
                    break;
                }
                if ($stop_on_first_error) {
                    break;
                }
            }
            if ($rule instanceof Rules\Required && \is_null($file)) {
                break;
            }
        }
        return $failed_rules;
    }

    public function push(Rule $rule): void
    {
        $this->_rules[] = $rule;
    }

    public function required(bool $required = true): void
    {
        $this->_rules[self::RULE_IDX_REQUIRED] = new Rules\Required($required);
    }
}