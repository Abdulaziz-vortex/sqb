<?php

namespace api\resources;

use api\resources\traits\ResourcesTrait;
use yii\data\ActiveDataProvider;
use yii\db\Exception;

class ShopResource extends \api\models\ShopModel
{

    public $query;      // stores the query for final result

    const SCENARIO_ALL = 'get_all';  // scenario for getting list of all shops
    const SCENARIO_ONE = 'get_one';  // scenario for getting list of a single specific shop

    use ResourcesTrait; // trait for resource functianaliti

    public function fields()
    {

        $fields = parent::fields();

        // here when scenario is SCENARIO_ALL it will show these fields id, name, created_at

        if ($this->scenario === self::SCENARIO_ALL) {
            $fields = [
                'id',
                'name',
                'created_at' => function ($model) {
                    $date = new \DateTime($model->created_at);
                    return $date->format('d.m.Y');
                }
            ];
        }

        // if scenario is SCENARIO_ONE it will display filds : previus fields + description

        if ($this->scenario === self::SCENARIO_ONE) {
            $fields = [
                'id',
                'name',
                'created_at' => function ($model) {
                    $date = new \DateTime($model->created_at);
                    return $date->format('d.m.Y');
                },
                'description'
            ];
        }
        return $fields;
    }

    /**
     * getOne this method gets one value from model
     * @var $id  - id of specific post
     */
    public function getOne($id = null)
    {

        $obj = clone $this;

        $obj->scenario = self::SCENARIO_ONE;

        if ($id === null) {
            $obj->query = self::find()
                ->where(['name' => $this->name]);
        } else {
            if (!is_numeric($id)) {
                throw new Exception('id must be type of int');
            }

            $obj->query = self::find()
                ->where(['id' => $id]);
        }

        return $obj;
    }


    // getAll this method gets all values from model in specific way

    public function getAll()
    {
        $obj = clone $this;

        $obj->query = self::find()->where(['status' => true]);

        $obj->scenario = self::SCENARIO_ALL;

        return $obj;
    }


    public function load($data, $formName = null)
    {
        $this->attributes = $data;
        if(empty($data['created_at']))
            $this->created_at = (new \DateTime())->format('d-m-Y h:i:s');
    }

}