<?php
/**
 * @author Anton Zoffmann
 * @copyright dasistweb GmbH (http://www.dasistweb.de)
 * Date: 13.09.16
 * Time: 15:05
 */

namespace Barbieswimcrew\Bundle\SymfonyFormRuleSetBundle\Structs\Rules\Base;


use Barbieswimcrew\Bundle\SymfonyFormRuleSetBundle\Exceptions\Rules\DuplicateRuleValueException;

abstract class AbstractBaseRuleSet implements RuleSetInterface
{
    /**
     * @var array
     */
    private $rules;

    /**
     * BasicRuleset constructor.
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = array();
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * @param RuleInterface $rule
     * @author Anton Zoffmann
     * @throws DuplicateRuleValueException
     */
    private function addRule(RuleInterface $rule)
    {

        if (array_key_exists($rule->getValue(), $this->rules)) {
            throw new DuplicateRuleValueException($rule->getValue());
        }

        $this->rules[$rule->getValue()] = $rule;
    }

    /**
     * @param $value
     * @author Anton Zoffmann
     * @return RuleInterface
     */
    public function getRule($value)
    {
        return $this->rules[$value];
    }


}