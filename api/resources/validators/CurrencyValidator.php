<?php

namespace api\resources\validators;

use api\resources\CurrencyResource;
use yii\base\Model;

class CurrencyValidator extends Model
{

    public $from;
    public $to;
    public $valuteId;

    public function rules()
    {
        return [
            [['from','to','valuteId'],'safe'],
            [['from','to'],'date', 'format' => 'php:Y-m-d'],
            ['valuteId','string'],
        ];
    }

}