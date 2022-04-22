<?php

namespace api\controllers;

use api\services\ProductService;

class ProductsController extends ApiController
{

    public $service;

    public function __construct(
        $id,
        $module,
        $config = [],
        ProductService $service
    ) {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        // enables serializer
        $this->setSerializer();

        return $this->service->index();
    }

    public function actionView($id)
    {
        return $this->service->view($id);
    }

}