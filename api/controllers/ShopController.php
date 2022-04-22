<?php

namespace api\controllers;

use api\resources\ShopResource;
use api\services\ShopService;
use Yii;

class ShopController extends ApiController
{

    public $service; // stores the service coresponding to controller

    public function __construct(  // here, i used Dependency Injection in order to use service inside Controller methods
        $id,
        $module,
        $config = [],
        ShopResource $resource,  // resource of shops
        ShopService $service
    ) {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->setSerializer();
        return $this->service->index();

    }

    public function actionView($id)
    {
        return $this->service->view($id);
    }


    public function actionCreate()
    {

        if (Yii::$app->request->getIsPost()) {

            $data = Yii::$app->request->post() ?? null;

            return $this->service->create($data);

        }
    }

    public function actionUpdate($id)
    {

        $data = Yii::$app->request->getBodyParams() ?? null;

        return $this->service->update($id, $data);
    }

    public function actionDelete($id)
    {
        return $this->service->delete($id);
    }


}