<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Car Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Car Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions'=>['class'=>'table table-striped table-bordered table-car'],
            'columns' => [
                'id',
                [
                    'format' => 'raw',
                    'attribute' => 'link',
                    'value' => function (\app\models\CarLink $model) {
                        $text = \yii\helpers\StringHelper::truncate($model->link, 100);
                        return Html::a($text, $model->link, ['target' => '_blank']);
                    }
                ],
                'created_at:datetime',
                'price_usd',
                'price_byn',
                'image:image',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Exception $e) {
    } ?>
</div>
