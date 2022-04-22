<?php

namespace api\models;

use yii\db\ActiveRecord;

class ProductModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'products';
    }

    public function getShops(){
        return $this->hasOne(ShopModel::className(),['id' => 'shop']);
    }
}