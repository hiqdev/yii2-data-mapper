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

/**
 * Class FilterField represents a field that can not be selected, but can
 * be used for filtering.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class FilterField extends Field
{
    /**
     * {@inheritdoc}
     */
    public function canBeSelected(): bool
    {
        return false;
    }
}
