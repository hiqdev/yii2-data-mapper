<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\Expression;

use yii\db\ExpressionInterface;

/**
 * Class HstoreExpression.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class HstoreExpression implements ExpressionInterface
{
    /**
     * @var array hash
     */
    private $hash;

    /**
     * CallExpression constructor.
     *
     * @param array $hash
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    public function getHash(): array
    {
        return $this->hash;
    }
}
