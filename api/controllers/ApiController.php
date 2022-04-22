<?php

namespace api\controllers;

use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                ],

            ],

        ];
    }

    // enables serializer

    public function setSerializer()
    {
        $this->serializer = [
            'class' => 'yii\rest\Serializer',
            'collectionEnvelope' => 'items',
        ];
    }
}