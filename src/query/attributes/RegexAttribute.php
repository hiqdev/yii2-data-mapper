<?php

namespace hiapi\query\attributes;

/**
 * Class FloatAttribute
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class RegexAttribute extends AbstractAttribute
{
    /**
     * @var string
     */
    protected $pattern;

    function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getOperatorRules()
    {
        $rule = ['match', 'pattern' => $this->pattern];

        return [
            'eq' => $rule,
            'ne' => $rule,
            'in' => ['each', 'rule' => $rule],
            'ni' => ['each', 'rule' => $rule],
            'like' => ['string'],
            'ilike' => ['string'],
        ];
    }
}
