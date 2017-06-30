<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\query\attributes;

/**
 * Class FloatAttribute.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class RegexAttribute extends AbstractAttribute
{
    /**
     * @var string
     */
    protected $pattern;

    public function __construct($pattern)
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
