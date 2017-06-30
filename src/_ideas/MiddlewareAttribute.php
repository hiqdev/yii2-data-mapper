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
 * Class MiddlewareAttribute.
 *
 * Usage:
 *
 * ```php
 * $attribute = new MiddlewareAttribute([
 *     new StringAttribute(),
 *     new RegexAttribute('^[a-z]+$'),
 * ]);
 * ```
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class MiddlewareAttribute implements AttributeInterface
{
    /**
     * @var array
     */
    private $middlewareAttribtues;

    public function __construct(...$attributes)
    {
        $this->middlewareAttribtues = $attributes;
    }

    public function getRuleForOperator($operator)
    {
        $rules = [];

        foreach ($this->middlewareAttribtues as $attribute) {
            /** @var AttributeInterface $attribute */
            $rules[] = $attribute->getRuleForOperator($operator);
        }

        return $rules;
    }
}
