<?php

namespace api\controllers;

use Yii;
use api\resources\CurrencyResource;
use api\services\CurrencyService;

class CurrencyController extends ApiController
{

    public CurrencyService $service; // stores the service of currency

    public function __construct(  // here, i used Dependency Injection in order to use service inside Controller methods
        $id,
        $module,
        $config = [],
        CurrencyService $service // service layer of currency
    )
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {

        $this->setSerializer(); // to serialize data with pagination and meta-data

        if (Yii::$app->request->get()) {

            return $this->service->withDate(Yii::$app->request->get());

        } else {

            return $this->service->index();

        }
    }

}