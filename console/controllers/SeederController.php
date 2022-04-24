<?php

// Console application for seeding data from api
// used for cron
namespace console\controllers;

use Yii;
use common\models\CurrencyModel;
use GuzzleHttp\Client;
use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\db\Exception;
use yii\httpclient;

class SeederController extends \yii\console\Controller
{

    public array $tmp;

    public function actionIndex()
    {

        $client = new Client();
        for ($i = 1; $i <= 30; $i++) {

            $date = date('d/m/Y', strtotime('-' . $i . 'day'));

            $request = $client->request('GET', 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date);

            $data = new \SimpleXMLElement($request->getBody());

            $this->tmp = [];

            foreach ($data->Valute as $item) {
                $value = floatval(preg_replace('/,/', '.', $item->Value));
                $value = number_format($value, 2);
                $this->tmp[] = [
                    $item['ID'],
                    $item->NumCode,
                    $item->CharCode,
                    $item->Name,
                    $value,
                    date('Y-m-d', strtotime('-' . $i . 'day'))
                ];
            }

//          inserting data to db from api

            $transaction = Yii::$app->db->beginTransaction(); // starting point of transaction

            try {
                Yii::$app->db->createCommand()->batchInsert(
                    CurrencyModel::tableName(),
                    ['valuteId', 'numCode', 'charCode', 'name', 'value', 'date'],
                    $this->tmp)
                    ->execute();

                $transaction->commit();
                echo 'successfuly inserted data of ' . $date.PHP_EOL;
            } catch (Exception $e) {
                $transaction->rollBack();
                print_r($e->getMessage());
            }

        }


    }

}