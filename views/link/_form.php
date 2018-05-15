<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'link')
        ->textInput([
            'maxlength' => true,
            'placeholder' => 'https://cars.av.by/search?brand_id%5B0%5D=6&model_id%5B0%5D=15&year_from=&year_to=&currency=USD&price_from'
        ]) ?>

    <?= $form->field($model, 'link_name')
        ->textInput([
            'maxlength' => true,
            'placeholder' => 'Parser Audi A6 C4 diesel'
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
