<?php
namespace api\resources\traits;

use yii\data\ActiveDataProvider;

trait ResourcesTrait{

    public $pageSize = 4;  // page size of pagination

    public $pagination = false;  // pagination is disabled by default

    public function withPagination()
    {

        $obj = clone $this;

        $obj->pagination = true;

        return $obj;
    }

    public function pageSize($size)
    {

        $obj = clone $this;

        $obj->pageSize = $size;

        return $obj;
    }

    public function data()
    {
        if ($this->pagination) {
            $config = [
                'query' => $this->query,
                'pagination' => [
                    'pageSize' => $this->pageSize,
                ]
            ];
        } else {
            $config = [
                'query' => $this->query,
            ];
        }



        $data = new ActiveDataProvider($config);
        
        if(empty($data->query->all())){
            return ['status' => false, 'message' => 'item doesn\'t exists'];
        }

        foreach ($data->getModels() as $model) {

            $model->scenario = $this->scenario;

        }

        return $data;
    }
}