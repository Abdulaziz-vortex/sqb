<?php

namespace api\resources;

use api\resources\traits\ResourcesTrait;
use common\models\CurrencyModel;
use yii\db\QueryInterface;
use api\resources\validators\CurrencyValidator;

class CurrencyResource extends CurrencyModel
{
    use ResourcesTrait;

    public QueryInterface $query;      // stores the query for final result

    public function from($date)
    {

        if($date === null){
            return $this;
        }

        $obj = clone $this;

        $obj->query = $obj->query->andWhere(['>=', 'date', $this->prepareDate($date)]);

        return $obj;
    }

    public function to($date)
    {
        if($date === null){
            return $this;
        }
        $obj = clone $this;

        $obj->query = $obj->query->andWhere(['<=', 'date', $this->prepareDate($date)]);

        return $obj;
    }

    public function andWhere($params)
    {
        if($params === null){
            return $this;
        }

        $obj = clone $this;

        $obj->query = $obj->query->andWhere($params);

        return $obj;
    }

    public function getAll()
    {
        $obj = clone $this;

        $obj->query = static::find();

        return $obj;
    }

    public function prepareDate($date){
        return date('Y-m-d',strtotime($date));
    }


}