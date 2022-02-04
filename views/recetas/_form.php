<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_prodp')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'P' => 'P', 'A' => 'A', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiempo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comensales')->textInput() ?>

    <?= $form->field($model, 'dificultad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredientes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pasos')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
