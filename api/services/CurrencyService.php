<?php

namespace api\services;

use api\resources\CurrencyResource;
use api\resources\validators\CurrencyValidator;
use yii\base\BaseObject;

class CurrencyService extends BaseObject
{

    public CurrencyResource $resource; // resource that coresponds to currency
    public CurrencyValidator $validator; // currency validator to validate data from client

    public function __construct(
        $config = [],
        CurrencyResource $resource,
        CurrencyValidator $validator
    )
    {
        $this->resource = $resource;
        $this->validator = $validator;

        parent::__construct($config);
    }

    public function index()
    {
        return $this->resource
            ->getAll()
            ->withPagination()
            ->pageSize(10)
            ->data();
    }

    public function withDate($params)
    {

        $this->validator->attributes = $params;

        if ($this->validator->validate()) {

            $valuteId = $params['valuteId'] ? ['valuteId' => $params['valuteId']] : null;

            return $this->resource
                ->getAll()
                ->from($params['from'])
                ->to($params['to'])
                ->withPagination()
                ->pageSize(10)
                ->andWhere($valuteId)
                ->data();

        } else {
            print_r($this->validator->getErrors());
        }
    }

}