<?php

namespace hiqdev\yii\DataMapper\query;

/**
 * Class FilterField represents a field that can not be selected, but can
 * be used for filtering
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class FilterField extends Field
{
    /**
     * {@inheritdoc}
     */
    public function canBeSelected()
    {
        return false;
    }
}
