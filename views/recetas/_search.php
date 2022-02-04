<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecetasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id_prodp') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'imagen') ?>

    <?php // echo $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'tiempo') ?>

    <?php // echo $form->field($model, 'comensales') ?>

    <?php // echo $form->field($model, 'dificultad') ?>

    <?php // echo $form->field($model, 'ingredientes') ?>

    <?php // echo $form->field($model, 'pasos') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
