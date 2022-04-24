<?php

namespace common\models;

use yii\db\ActiveRecord;

class CurrencyModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'currency';
    }
}