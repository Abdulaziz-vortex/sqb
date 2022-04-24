<?php

use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\widgets\ChartWidget;
/** @var yii\web\View $this */

$this->title = 'Sqb Bank task';

$month = ArrayHelper::map($provider->query->asArray()->all(), 'id', 'date');
$value = ArrayHelper::map($provider->query->asArray()->all(), 'id', 'value');

?>
<div class="site-index">

    <div class="body-content">

        <?php
        $form = ActiveForm::begin([
            'method' => 'get',
            'options' => [
                'class' => 'input-group align-items-start'
            ]
        ]);
        echo $form->field($model, 'from')->input('date')->label(false);
        echo $form->field($model, 'to')->input('date')->label(false);
        echo Html::submitButton("<i class='fa fa-filter mr-2'></i>".'фильтр', ['class' => 'btn btn-primary']);
        echo Html::resetButton("<i class='fa fa-times mr-2'></i>".'очистить', ['class' => 'btn btn-danger']);
        ActiveForm::end();

        ?>
        <hr>
        <?php
        echo GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $model,
            'columns' => [
                'id',
                'valuteId',
                'numCode',
                [
                    'attribute' => 'charCode',
                    'filter' => ArrayHelper::map(\common\models\CurrencySearch::find()->asArray()->groupBy('charCode')->all(), 'charCode', 'charCode')
                ],
                'value',
                'name',
                [
                    'attribute' => 'date',
                    'format' => ['date', 'php:Y-m-d']
                ]
            ]
        ]);

        echo \yii\bootstrap4\LinkPager::widget(['pagination' => $pages]);

        ?>

    </div>

    <?php
    if ($has_chart) {
        echo ChartWidget::widget(['month' => $month, 'value' => $value]);
    }
    ?>


</div>

