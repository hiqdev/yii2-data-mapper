<?php

namespace hiapi\query\attributes;

/**
 * Class MiddlewareAttribute
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

    public function __construct(... $attributes)
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
