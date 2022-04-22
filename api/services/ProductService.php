<?php

namespace api\services;

use api\resources\ProductResource;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

class ProductService extends BaseObject
{
    public $resource; // resours that coresponds to products

    public function __construct(
        $config = [],
        ProductResource $resource
    ) {
        $this->resource = $resource;
        parent::__construct($config);
    }

    // index method gets all data from table with pagination

    public function index(): ActiveDataProvider
    {

        return $this->resource->getAll()->withPagination()->pageSize(7)->data();

    }

    public function view($id): ActiveDataProvider
    {

        return $this->resource->getOne($id)->data();

    }
}