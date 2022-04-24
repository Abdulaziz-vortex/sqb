<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class CurrencySearch extends CurrencyModel
{
    public $from;
    public $to;
    public $pagination;

    public function rules()
    {
        $rules = array_merge(parent::rules(), [
            [['from', 'to','charCode'], 'safe']
        ]);
        return $rules;
    }

    public function search($params)
    {

        $query = parent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        if (!($this->load($params) && $this->validate())) {
            print_r('adsdas');

            $pagination = new Pagination(['totalCount' => $query->count(),'pageSize' => 20]);
            $this->pagination = $pagination;
            $query->offset($pagination->offset)
                ->limit($pagination->limit);
            return $dataProvider;
        }

        if(!empty($this->from) && !empty($this->to)){
            $query->andWhere(['>=', 'date', $this->from])
                ->andWhere(['<=', 'date', $this->to]);
        }
        if(!empty($this->charCode)){
            $query->andWhere(['=','charCode', $this->charCode])
                ->orderBy(['date' => SORT_ASC]);
        }

        $pagination = new Pagination(['totalCount' => $query->count(),'pageSize' => 20]);

        $this->pagination = $pagination;

        $query->offset($pagination->offset)
            ->limit($pagination->limit);


        return $dataProvider;
    }

    public function attributeLabels()
    {
        return ['from' => 'от', 'to' => 'до'];
    }

}