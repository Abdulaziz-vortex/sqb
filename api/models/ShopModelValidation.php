<?php

namespace api\models;

use yii\base\Model;

class ShopModelValidation extends ShopModel
{



    public function rules()
    {
        return [
            ['name','required'],
            ['name','unique'],
            ['status','boolean'],
            ['description','safe']
        ];
    }


}