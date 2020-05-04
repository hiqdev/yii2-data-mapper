<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

final class JoinedField implements FieldInterface, JoinedFieldInterface
{
    /**
     * @var FieldInterface
     */
    private FieldInterface $field;
    private string         $joinName;

    public function __construct(FieldInterface $field, string $joinName)
    {
        $this->field = $field;
        $this->joinName = $joinName;
    }

    public function getJoinName(): string
    {
        return $this->joinName;
    }

    public function getName(): string
    {
        return $this->field->getName();
    }

    public function getSql()
    {
        return $this->field->getSql();
    }

    public function canBeSelected(): bool
    {
        return $this->field->canBeSelected();
    }
}
