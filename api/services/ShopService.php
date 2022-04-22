<?php

namespace api\services;

use Yii;
use api\models\ShopModel;
use api\models\ShopModelValidation;
use api\resources\ShopResource;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

class ShopService extends BaseObject
{
    /**
     * @var $resource ShopResource
     */
    public $resource; // resource that coresponds to shop

    /**
     * @var $model ShopModel
     */

    public $model;  // model of shop

    /**
     * @var $validator ShopModelValidation
     */

    public $validator;  // validator of shop model

    public function __construct(
        $config = [],
        ShopResource $resource,
        ShopModel $model,
        ShopModelValidation $validator
    ) {
        parent::__construct($config);

        $this->resource = $resource;
        $this->model = $model;
        $this->validator = $validator;
    }


    public function create($data)
    {
        $this->validator->load($data,'');

        if($this->validator->validate()){
            $this->validator->save();
            return $this->resource->getOne($this->validator->id)->data();
        }else{
            return $this->validator->getErrors();
        }
    }

    public function view($id): ActiveDataProvider
    {

        return $this->resource->getOne($id)->data();

    }

    // index method that gets all data from table in specific way

    public function index(): ActiveDataProvider
    {
        return $this->resource
            ->getAll()
            ->withPagination()
            ->pageSize(5)
            ->data();
    }

    // update method, updates table from received data

    public function update($id, $data)
    {

        $this->validator = $this->validator::findOne($id);

        if(empty($this->validator)){
            return ['status' => false,'message' => 'id not found'];
        }

        $this->validator->load($data, '');

        if ($this->validator->validate()) {

            $this->validator->save();

            $result = $this->resource->getOne($this->validator->id)->data();

            return $result;

        } else {
            return $this->validator->getErrors();
        }

    }

    public function delete($id)
    {

        $item = $this->model::findOne(['id' => $id]) ?? null;

        if ($item === null) {
            return ['status' => false, 'message' => 'post not exists'];
        } else {
            $item->delete();
            return ['status' => true];
        }


    }

}