<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\hydrator;

use DateTime;
use DateTimeImmutable;

/**
 * Class PlanHydrator.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class DateTimeImmutableHydrator extends GeneratedHydrator
{
    /**
     * {@inheritdoc}
     * @param object|DateTimeImmutable $object
     */
    public function hydrate(array $data, $object)
    {
        return new DateTimeImmutable(reset($data));
    }

    /**
     * {@inheritdoc}
     * @param object|DateTimeImmutable $object
     */
    public function extract($object)
    {
        return $object->format(DateTime::ATOM);
    }
}
