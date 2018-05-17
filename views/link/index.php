<?php

use app\models\Link;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Links';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'format' => 'raw',
                    'attribute' => 'link',
                    'value' => function (Link $model) {
                        $text = \yii\helpers\StringHelper::truncate($model->link, 50);
                        return Html::a($text, $model->link, ['target' => '_blank']);
                    }
                ],
                [
                    'attribute' => 'link_name',
                    'value' => function (Link $model) {
                        return $model->link_name;
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function (Link $model) {
                        return $model->status === Link::STATUS_ACTIVE ? 'active' : 'disable';
                    }
                ],
                'created_at:datetime',
                'expired_at:datetime',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Exception $e) {
    } ?>
</div>
