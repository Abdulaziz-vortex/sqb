<?php

namespace frontend\widgets;

class ChartWidget extends \yii\base\Widget
{

    public $month;
    public $value;

    public function run()
    {
        return $this->render('chart', ['month' => $this->month, 'value' => $this->value]);
    }

}